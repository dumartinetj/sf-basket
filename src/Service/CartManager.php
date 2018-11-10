<?php

namespace App\Service;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;

class CartManager{

    public function addProduct(Product $product, Request $request){
        $cart = (is_array($request->getSession()->get('cart')))?$request->getSession()->get('cart'):[];

        $quantityToAdd = intval($request->request->get('quantity'));

        if(array_key_exists($product->getId(), $cart)){
            $currentQty = $cart[$product->getId()]['quantity'];
            $cart[$product->getId()]['quantity'] = $currentQty+$quantityToAdd;
        }else{
            $cart[$product->getId()] = array(
                "product"   => $product,
                "quantity"  => $quantityToAdd
            );
        }

        $this->updateCart($request, $cart);

        $request->getSession()->getFlashbag()->add("success", $quantityToAdd."x ".$product->getName()." ajouté(s) au panier");
    }

    public function editProduct(Product $product, Request $request){
        $cart = (is_array($request->getSession()->get('cart')))?$request->getSession()->get('cart'):[];

        $quantityToEdit = intval($request->request->get('quantity'));

        if(array_key_exists($product->getId(), $cart)){
            if($quantityToEdit > 0){
                $cart[$product->getId()]['quantity'] = $quantityToEdit;
                $request->getSession()->getFlashbag()->add("success", $quantityToEdit."x ".$product->getName()." dans le panier");
            }else{
                unset($cart[$product->getId()]);
                $request->getSession()->getFlashbag()->add("success", $product->getName()." supprimé du panier");
            }
        }

        $this->updateCart($request, $cart);
    }

    public function removeProduct(Product $product, Request $request){
        $cart = (is_array($request->getSession()->get('cart')))?$request->getSession()->get('cart'):[];

        if(array_key_exists($product->getId(), $cart)){
            unset($cart[$product->getId()]);
        }
        $this->updateCart($request, $cart);

        $request->getSession()->getFlashbag()->add("success", $product->getName()." supprimé du panier");

    }

    public function empty(Request $request){
        $this->updateCart($request);

        $request->getSession()->getFlashbag()->add("success", "Votre panier a bien été vidé");
    }

    private function updateCart(Request $request, $cart = []){
        $cartAmount     = 0;
        $cartQuantity   = 0;

        foreach($cart as $cartItem){
            $cartQuantity   += intval($cartItem['quantity']);
            $cartAmount     += intval($cartItem['quantity']) * $cartItem['product']->getPrice();
        }

        $request->getSession()->set('cart', $cart);
        $request->getSession()->set('cart_amount', $cartAmount);
        $request->getSession()->set('cart_quantity', $cartQuantity);
    }
}