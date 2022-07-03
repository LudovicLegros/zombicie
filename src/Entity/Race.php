<?php

namespace App\Entity;

use App\Repository\RaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RaceRepository::class)]
class Race
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $raceName;

    #[ORM\ManyToMany(targetEntity: Survivant::class, inversedBy: 'races')]
    private $survivantRace;

    public function __construct()
    {
        $this->survivantRace = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaceName(): ?string
    {
        return $this->raceName;
    }

    public function setRaceName(string $raceName): self
    {
        $this->raceName = $raceName;

        return $this;
    }

    /**
     * @return Collection<int, Survivant>
     */
    public function getSurvivantRace(): Collection
    {
        return $this->survivantRace;
    }

    public function addSurvivantRace(Survivant $survivantRace): self
    {
        if (!$this->survivantRace->contains($survivantRace)) {
            $this->survivantRace[] = $survivantRace;
        }

        return $this;
    }

    public function removeSurvivantRace(Survivant $survivantRace): self
    {
        $this->survivantRace->removeElement($survivantRace);

        return $this;
    }

    public function __toString(){
        return $this->raceName;
    }
}
