<?php

namespace App\Controller\API;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;

class ProductController extends AbstractController
{
    /**
     * Liste des produits
     *
     * @Rest\Get("/api/products", name="api_products")
     * @Rest\View(serializerGroups={"Default"})
     * @SWG\Tag(name="Public")
     * @SWG\Response(
     *     response=200,
     *     description="Liste des produits",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Product::class))
     *     )
     * )
     * @param ProductRepository $productRepo
     * @return array
     */
    public function getProducts(ProductRepository $productRepo)
    {
        return $productRepo->findBy([], ['name' => 'ASC']);
    }
}
