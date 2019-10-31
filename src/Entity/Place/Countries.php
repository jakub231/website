<?php


namespace App\Entity\Place;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="countries")
 */
class Countries
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="string")
     */
    private $id;

    /**
     * @ORM\Column(name="name_en", type="string", nullable=false, unique=true)
     */
    private $name_en;

    /**
     * @ORM\Column(name="name_bg", type="string", nullable=false, unique=true)
     */
    private $name_bg;

    /**
     * @ORM\Column(name="geojson", type="json", nullable=false)
     */
    private $geojson;

    /**
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNameEn()
    {
        return $this->name_en;
    }

    /**
     * @param mixed $name_en
     */
    public function setNameEn($name_en): void
    {
        $this->name_en = $name_en;
    }

    /**
     * @return mixed
     */
    public function getNameBg()
    {
        return $this->name_bg;
    }

    /**
     * @param mixed $name_bg
     */
    public function setNameBg($name_bg): void
    {
        $this->name_bg = $name_bg;
    }

    /**
     * @return mixed
     */
    public function getGeojson()
    {
        return $this->geojson;
    }

    /**
     * @param mixed $geojson
     */
    public function setGeojson($geojson): void
    {
        $this->geojson = $geojson;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }
}