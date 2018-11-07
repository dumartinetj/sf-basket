<?php

namespace App\Service;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;

class CartManager{

    public function addProduct(Product $product, Request $request){
        $cart = $request->getSession()->get('cart');
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
}