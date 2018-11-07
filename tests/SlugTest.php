<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;

class SlugTest extends TestCase
{
    public function testSlug()
    {

        $this->assertEquals("teste-le-slug", $this->slugify("Tésté le slug@"));
        $this->assertEquals("teste-le-slug", $this->slugify("Tésté!-le_slug@"));
        $this->assertEquals("t-este-le-slug", $this->slugify("T'éstê  le slug"));
    }

    private function slugify($string){
        setlocale(LC_CTYPE, "fr_FR.UTF-8");

        $slug = preg_replace('~[^\pL\d]+~u', '-', $string); // replace non letter or digits by -
        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug); // transliterate
        $slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
        $slug = trim($slug, '-'); // trim
        $slug = preg_replace('~-+~', '-', $slug); // remove duplicate -

        return strtolower($slug);
    }
}
