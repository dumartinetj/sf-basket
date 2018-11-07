<?php

namespace App\Tests\Service;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class CartManagerTest extends TestCase
{
    public function testTotalAmount()
    {
        $product1 = new Product();
        $product1
            ->setName("Test")
            ->setPrice(13.9);

        $product2 = new Product();
        $product2
            ->setName("Test2")
            ->setPrice(216.3);

        $cart = array(
            array(
                "product"   => $product1,
                "quantity"  => 12
            ),
            array(
                "product"   => $product2,
                "quantity"  => 3
            )
        );
        $this->assertEquals(815.7, $this->getTotalAmount($cart));

        $this->assertEquals(0, $this->getTotalAmount(null));
    }

    private function getTotalAmount($cart){
        $totalAmount = 0;

        if(is_array($cart)){
            foreach($cart as $cartItem){
                $totalAmount += $cartItem['product']->getPrice()*$cartItem['quantity'];
            }
        }

        return $totalAmount;
    }
}
