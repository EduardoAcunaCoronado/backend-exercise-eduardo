<?php

namespace App\Model;

use Symfony\Component\Serializer\Annotation\Groups;

class Beer {

    /**
     * @Groups({"find", "details"})
     */
    private $id;

    /**
     * @Groups({"find", "details"})
     */
    private $name;

    /**
     * @Groups({"find", "details"})
     */
    private $description;

    /**
     * @Groups({"details"})
     */
    private $imageUrl;

    /**
     * @Groups({"details"})
     */
    private $tagline;

    /**
     * @Groups({"details"})
     */
    private $firstBrewed;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return mixed
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    /**
     * @param mixed $tagline
     */
    public function setTagline($tagline): void
    {
        $this->tagline = $tagline;
    }

    /**
     * @return mixed
     */
    public function getFirstBrewed()
    {
        return $this->firstBrewed;
    }

    /**
     * @param mixed $firstBrewed
     */
    public function setFirstBrewed($firstBrewed): void
    {
        $this->firstBrewed = $firstBrewed;
    }


}