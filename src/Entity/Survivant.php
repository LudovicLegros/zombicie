<?php

namespace App\Entity;

use App\Repository\SurvivantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SurvivantRepository::class)]
class Survivant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\ManyToOne(targetEntity: Skill::class, inversedBy: 'survivantsBlue1')]
    #[ORM\JoinColumn(nullable: false)]
    private $blueskill1;

    #[ORM\ManyToOne(targetEntity: Skill::class, inversedBy: 'survivantsBlue2')]
    private $blueskill2;

    #[ORM\ManyToOne(targetEntity: Skill::class, inversedBy: 'survivantsYellow')]
    #[ORM\JoinColumn(nullable: false)]
    private $yellowskill;

    #[ORM\ManyToOne(targetEntity: Skill::class, inversedBy: 'survivantsOrange1')]
    #[ORM\JoinColumn(nullable: false)]
    private $orangeskill1;

    #[ORM\ManyToOne(targetEntity: Skill::class, inversedBy: 'survivantsOrange2')]
    #[ORM\JoinColumn(nullable: false)]
    private $orangeskill2;

    #[ORM\ManyToOne(targetEntity: Skill::class, inversedBy: 'survivantsRed1')]
    #[ORM\JoinColumn(nullable: false)]
    private $redskill1;

    #[ORM\ManyToOne(targetEntity: Skill::class, inversedBy: 'survivantsRed2')]
    #[ORM\JoinColumn(nullable: false)]
    private $redskill2;

    #[ORM\ManyToOne(targetEntity: Skill::class, inversedBy: 'survivantsRed3')]
    #[ORM\JoinColumn(nullable: false)]
    private $redskill3;

    #[ORM\ManyToMany(targetEntity: Classe::class, mappedBy: 'survivantClasse')]
    private $classes;

    #[ORM\ManyToMany(targetEntity: Race::class, mappedBy: 'survivantRace')]
    private $races;

    #[ORM\ManyToMany(targetEntity: Profil::class, mappedBy: 'profilsurvivants')]
    private $profils;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
        $this->races = new ArrayCollection();
        $this->profils = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getBlueskill1(): ?Skill
    {
        return $this->blueskill1;
    }

    public function setBlueskill1(?Skill $blueskill1): self
    {
        $this->blueskill1 = $blueskill1;

        return $this;
    }

    public function getBlueskill2(): ?Skill
    {
        return $this->blueskill2;
    }

    public function setBlueskill2(?Skill $blueskill2): self
    {
        $this->blueskill2 = $blueskill2;

        return $this;
    }

    public function getYellowskill(): ?Skill
    {
        return $this->yellowskill;
    }

    public function setYellowskill(?Skill $yellowskill): self
    {
        $this->yellowskill = $yellowskill;

        return $this;
    }

    public function getOrangeskill1(): ?Skill
    {
        return $this->orangeskill1;
    }

    public function setOrangeskill1(?Skill $orangeskill1): self
    {
        $this->orangeskill1 = $orangeskill1;

        return $this;
    }

    public function getOrangeskill2(): ?Skill
    {
        return $this->orangeskill2;
    }

    public function setOrangeskill2(?Skill $orangeskill2): self
    {
        $this->orangeskill2 = $orangeskill2;

        return $this;
    }

    public function getRedskill1(): ?Skill
    {
        return $this->redskill1;
    }

    public function setRedskill1(?Skill $redskill1): self
    {
        $this->redskill1 = $redskill1;

        return $this;
    }

    public function getRedskill2(): ?Skill
    {
        return $this->redskill2;
    }

    public function setRedskill2(?Skill $redskill2): self
    {
        $this->redskill2 = $redskill2;

        return $this;
    }

    public function getRedskill3(): ?Skill
    {
        return $this->redskill3;
    }

    public function setRedskill3(?Skill $redskill3): self
    {
        $this->redskill3 = $redskill3;

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
            $class->addSurvivantClasse($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            $class->removeSurvivantClasse($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Race>
     */
    public function getRaces(): Collection
    {
        return $this->races;
    }

    public function addRace(Race $race): self
    {
        if (!$this->races->contains($race)) {
            $this->races[] = $race;
            $race->addSurvivantRace($this);
        }

        return $this;
    }

    public function removeRace(Race $race): self
    {
        if ($this->races->removeElement($race)) {
            $race->removeSurvivantRace($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Profil>
     */
    public function getProfils(): Collection
    {
        return $this->profils;
    }

    public function addProfil(Profil $profil): self
    {
        if (!$this->profils->contains($profil)) {
            $this->profils[] = $profil;
            $profil->addProfilsurvivant($this);
        }

        return $this;
    }

    public function removeProfil(Profil $profil): self
    {
        if ($this->profils->removeElement($profil)) {
            $profil->removeProfilsurvivant($this);
        }

        return $this;
    }
}
