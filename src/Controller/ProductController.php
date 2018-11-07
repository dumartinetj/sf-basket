<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * Liste des produits
     *
     * @Route("/products", methods={"GET"}, name="product_list")
     * @param ProductRepository $productRepo
     * @return Response
     */
    public function list(ProductRepository $productRepo)
    {
        return $this->render('product/list.html.twig', [
            "products" => $productRepo->findBy([], ['name' => 'ASC'])
        ]);
    }

    /**
     * Fiche produit
     *
     * @Route("/product/{slug}", methods={"GET"}, name="product_show")
     * @param Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        return $this->render('product/show.html.twig', [
            "product" => $product
        ]);
    }
}
