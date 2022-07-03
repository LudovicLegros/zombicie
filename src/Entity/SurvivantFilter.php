<?php
namespace App\Entity;

// use App\Entity\Race;


class SurvivantFilter 
{
    private $races;
    private $classes;

    public function getRacename() 
    {
        return $this->races;
    }

    public function setRacename($races)
    {
        $this->races = $races;
        return $this;
    }

    public function getClasseName() 
    {
        return $this->classes;
    }

    public function setClasseName($classes)
    {
        $this->classes = $classes;
        return $this;
    }

    // #[ORM\Column(targetEntity: Race::class, inversedBy: 'races')]
    // public $races;

}