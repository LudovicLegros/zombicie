<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $className;

    #[ORM\ManyToMany(targetEntity: Survivant::class, inversedBy: 'classes')]
    private $survivantClasse;

    public function __construct()
    {
        $this->survivantClasse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassName(): ?string
    {
        return $this->className;
    }

    public function setClassName(string $className): self
    {
        $this->className = $className;

        return $this;
    }

    /**
     * @return Collection<int, Survivant>
     */
    public function getSurvivantClasse(): Collection
    {
        return $this->survivantClasse;
    }

    public function addSurvivantClasse(Survivant $survivantClasse): self
    {
        if (!$this->survivantClasse->contains($survivantClasse)) {
            $this->survivantClasse[] = $survivantClasse;
        }

        return $this;
    }

    public function removeSurvivantClasse(Survivant $survivantClasse): self
    {
        $this->survivantClasse->removeElement($survivantClasse);

        return $this;
    }

    public function __toString(){
        return $this->className;
    }
}
