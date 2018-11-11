<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $productArray = array(
            array(
                "name"          => "Harry Potter à l'école des sorciers",
                "description"   => "Harry Potter - Tome 1 - Harry Potter à l'école des sorciers par J. K. Rowling",
                "price"         => 8.5
            ),
            array(
                "name"          => "Harry Potter et la Chambre des Secrets",
                "description"   => "Harry Potter - Tome 2 - Harry Potter et la Chambre des Secrets par J. K. Rowling",
                "price"         => 8.5
            ),
            array(
                "name"          => "Harry Potter et le prisonnier d'Azkaban",
                "description"   => "Harry Potter - Tome 3 - Harry Potter et le prisonnier d'Azkaban par J. K. Rowling",
                "price"         => 8.9
            ),
            array(
                "name"          => "Harry Potter et la Coupe de Feu",
                "description"   => "Harry Potter - Tome 4 - Harry Potter et la Coupe de Feu par J. K. Rowling",
                "price"         => 13.5
            ),
            array(
                "name"          => "Harry Potter et l'Ordre du Phénix",
                "description"   => "Harry Potter - Tome 5 - Harry Potter et l'Ordre du Phénix par J. K. Rowling",
                "price"         => 14.9
            ),
            array(
                "name"          => "Harry Potter et le Prince de Sang-Mêlé",
                "description"   => "Harry Potter - Tome 6 - Harry Potter et le Prince de Sang-Mêlé par J. K. Rowling",
                "price"         => 13.5
            ),
            array(
                "name"          => "Harry Potter et les Reliques de la Mort",
                "description"   => "Harry Potter - Tome 7 - Harry Potter et les Reliques de la Mort par J. K. Rowling",
                "price"         => 13.5
            ),
            array(
                "name"          => "Le Trône de fer - Tome 1",
                "description"   => "Le Trône de fer - Tome 1 par George R. R. Martin",
                "price"         => 15.9
            ),
            array(
                "name"          => "Le Trône de fer - Tome 2",
                "description"   => "Le Trône de fer - Tome 2 par George R. R. Martin",
                "price"         => 15
            ),
            array(
                "name"          => "Le Trône de fer - Tome 3",
                "description"   => "Le Trône de fer - Tome 3 par George R. R. Martin",
                "price"         => 12.5
            ),
            array(
                "name"          => "Le Trône de fer - Tome 4",
                "description"   => "Le Trône de fer - Tome 4 par George R. R. Martin",
                "price"         => 19.4
            ),
            array(
                "name"          => "Le Trône de fer - Tome 5",
                "description"   => "Le Trône de fer - Tome 5 par George R. R. Martin",
                "price"         => 14
            )
        );

        foreach($productArray as $productToCreate){
            $product = new Product();
            $product
                ->setName($productToCreate['name'])
                ->setDescription($productToCreate['description'])
                ->setPrice($productToCreate['price'])
                ->setImage($product->getSlug().".jpg");
            $manager->persist($product);
        }
        $manager->flush();
    }
}
