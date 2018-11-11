<?php

namespace App\Utils;

use App\Entity\Area;
use App\Entity\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Naming\NamerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;


class FileNamer implements NamerInterface
{

    /**
     * @param object $object
     * @param PropertyMapping $mapping
     * @return string
     */
    function name($object, PropertyMapping $mapping): string
    {

        $file = $mapping->getFile($object);
        $extension = $this->getExtension($file);

        if(property_exists($object, "slug")){
            return $object->getSlug().'.'.$extension;
        }

        return $file->getClientOriginalName();
    }

    private function getExtension(UploadedFile $file)
    {
        $originalName = $file->getClientOriginalName();

        if ($extension = pathinfo($originalName, PATHINFO_EXTENSION)) {
            return $extension;
        }

        if ($extension = $file->guessExtension()) {
            return $extension;
        }

        return null;
    }
}