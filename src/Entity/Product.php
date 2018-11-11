<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use JMS\Serializer\Annotation AS Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @Vich\Uploadable
 * @Serializer\ExclusionPolicy("all")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string | null
     *
     * @Serializer\Expose()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=150)
     * @var string | null
     *
     * @Serializer\Expose()
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string | null
     *
     * @Serializer\Expose()
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     * @var string | null
     *
     * @Serializer\Expose()
     * @Serializer\Accessor(getter="getFullImageUrl")
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="image")
     * @var File | null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime | null
     */
    private $uploadedAt;

    /**
     * @ORM\Column(type="float")
     * @var float | null
     *
     * @Serializer\Expose()
     */
    private $price;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Product
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName(string $name): Product
    {
        $this->name = $name;
        $this->setSlug($name);

        return $this;
    }

    /**
     * @return null|string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Product
     */
    public function setSlug(string $slug): Product
    {
        setlocale(LC_CTYPE, "fr_FR.UTF-8");
        $slug = preg_replace('~[^\pL\d]+~u', '-', $slug); // replace non letter or digits by -
        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug); // transliterate
        $slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
        $slug = trim($slug, '-'); // trim
        $slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
        $slug = strtolower($slug); // lowercase

        $this->slug = (!empty($slug))?$slug:null;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     * @return Product
     */
    public function setDescription(?string $description): Product
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getFullImageUrl(): ?string
    {
        return ($this->image)?"/images/products/".$this->image:null;
    }

    /**
     * @param null|string $image
     * @return Product
     */
    public function setImage(?string $image): Product
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Product
     */
    public function setImageFile(File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->uploadedAt = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUploadedAt(): ?\DateTime
    {
        return $this->uploadedAt;
    }

    /**
     * @param \DateTime|null $uploadedAt
     * @return Product
     */
    public function setUploadedAt(?\DateTime $uploadedAt): Product
    {
        $this->uploadedAt = $uploadedAt;
        return $this;
    }

    /**
     * @return null|float
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Product
     */
    public function setPrice(float $price): Product
    {
        $this->price = $price;
        return $this;
    }
}
