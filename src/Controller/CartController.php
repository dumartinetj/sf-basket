<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * Panier
     *
     * @Route("/cart", methods={"GET"}, name="cart_index")
     *
     * @return Response
     */
    public function index()
    {
        return $this->render('cart/index.html.twig', []);
    }

    /**
     * Ajout d'un produit au panier
     *
     * @Route("/cart/add-product/{id}", methods={"POST"}, name="cart_add_product")
     *
     * @param Product $product
     * @param Request $request
     * @param CartManager $cartManager
     * @return RedirectResponse
     */
    public function addProduct(Product $product, Request $request, CartManager $cartManager){

        $cartManager->addProduct($product, $request);

        return new RedirectResponse($request->headers->get('referer'));
    }

    /**
     * Suppression d'un produit du panier
     *
     * @Route("/cart/remove-product/{id}", methods={"POST"}, name="cart_remove_product")
     *
     * @param Product $product
     * @param Request $request
     * @param CartManager $cartManager
     */
    public function removeProduct(Product $product, Request $request, CartManager $cartManager){

    }
}
