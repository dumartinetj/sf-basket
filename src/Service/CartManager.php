<?php

namespace App\Service;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;

class CartManager{

    public function addProduct(Product $product, Request $request){
        $cart = $request->getSession()->get('cart');
        if(!is_array($cart)){
            $cart = array();
        }
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
        $request->getSession()->set('cart', $cart);
        $request->getSession()->getFlashbag()->add("success", $quantityToAdd."x ".$product->getName()." ajouté(s) au panier");
    }

    public function getTotalAmount(Request $request){
        $totalAmount = 0;

        if($request->getSession()->has('cart') && is_array($request->getSession()->get('cart'))){
            foreach($request->getSession()->get('cart') as $cartItem){
                $totalAmount += $cartItem['product']->getPrice()*$cartItem['quantity'];
            }
        }

        return $totalAmount;
    }
}