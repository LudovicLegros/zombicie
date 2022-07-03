<?php
namespace App\Entity;

// use App\Entity\Race;


class SurvivantFilter 
{
    private $races;

    public function getRacename() 
    {
        return $this->races;
    }

    public function setRacename($races)
    {
        $this->races = $races;
        return $this;
    }

    // #[ORM\Column(targetEntity: Race::class, inversedBy: 'races')]
    // public $races;

}