<?php

namespace App\Tests\Service;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class CartManagerTest extends TestCase
{

    public function testCart(){

        $product1 = new Product();
        $product1
            ->setName("Test 1")
            ->setPrice(10);

        $product2 = new Product();
        $product2
            ->setName("Test 2")
            ->setPrice(1);

        $cart = [];

        //Ajout d'un produit non présent dans le panier vide
        $cart = $this->addProduct($product1, 1, 10, $cart);
        $this->assertEquals(10, $this->getCartQuantity($cart));
        $this->assertEquals(100, $this->getCartAmount($cart));

        //Ajout d'un nouveau produit non présent dans le panier
        $cart = $this->addProduct($product2, 2, 2, $cart);
        $this->assertEquals(12, $this->getCartQuantity($cart));
        $this->assertEquals(102, $this->getCartAmount($cart));

        //Ajout d'un produit déjà présent dans le panier
        $cart = $this->addProduct($product1, 1, 5, $cart);
        $this->assertEquals(17, $this->getCartQuantity($cart));
        $this->assertEquals(152, $this->getCartAmount($cart));

        //Edition de la quantité d'un produit dans le panier
        $cart = $this->editProduct($product1, 1, 20, $cart);
        $this->assertEquals(22, $this->getCartQuantity($cart));
        $this->assertEquals(202, $this->getCartAmount($cart));

        //Mise à 0 de la quantité d'un produit dans le panier
        $cart = $this->editProduct($product1, 2, 0, $cart);
        $this->assertEquals(20, $this->getCartQuantity($cart));
        $this->assertEquals(200, $this->getCartAmount($cart));

        //Ajout d'un nouveau produit non présent dans le panier
        $cart = $this->addProduct($product2, 2, 1, $cart);
        $this->assertEquals(21, $this->getCartQuantity($cart));
        $this->assertEquals(201, $this->getCartAmount($cart));

        //Suppression d'une ligne du panier
        $cart = $this->removeProduct($product2, 2, $cart);
        $this->assertEquals(20, $this->getCartQuantity($cart));
        $this->assertEquals(200, $this->getCartAmount($cart));

        //Réinitialisation du panier
        $cart = $this->empty($cart);
        $this->assertEquals(0, $this->getCartQuantity($cart));
        $this->assertEquals(0, $this->getCartAmount($cart));
    }

    private function addProduct(Product $product, $productId, $quantity, $cart){

        if(array_key_exists($productId, $cart)){
            $currentQty = $cart[$productId]['quantity'];
            $cart[$productId]['quantity'] = $currentQty+$quantity;
        }else{
            $cart[$productId] = array(
                "product"   => $product,
                "quantity"  => $quantity
            );
        }

        return $cart;
    }

    private function editProduct(Product $product, $productId, $quantity, $cart){
        if(array_key_exists($productId, $cart)){
            if($quantity > 0){
                $cart[$productId]['quantity'] = $quantity;
            }else{
                unset($cart[$productId]);
            }
        }

        return $cart;
    }

    private function removeProduct(Product $product, $productId, $cart){
        if(array_key_exists($productId, $cart)){
            unset($cart[$productId]);
        }
        return $cart;
    }

    public function empty($cart = array()){
        return array();
    }

    private function getCartAmount($cart = []){
        $cartAmount     = 0;
        foreach($cart as $cartItem){
            $cartAmount     += intval($cartItem['quantity']) * $cartItem['product']->getPrice();
        }
        return $cartAmount;
    }

    private function getCartQuantity($cart = []){
        $cartQuantity     = 0;
        foreach($cart as $cartItem){
            $cartQuantity     += intval($cartItem['quantity']);
        }
        return $cartQuantity;
    }
}
