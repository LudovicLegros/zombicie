<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkillRepository::class)]
class Skill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $skillName;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\OneToMany(mappedBy: 'blueskill1', targetEntity: Survivant::class)]
    private $survivantsBlue1;

    #[ORM\OneToMany(mappedBy: 'blueskill2', targetEntity: Survivant::class)]
    private $survivantsBlue2;

    #[ORM\OneToMany(mappedBy: 'yellowskill', targetEntity: Survivant::class)]
    private $survivantsYellow;

    #[ORM\OneToMany(mappedBy: 'orangeskill1', targetEntity: Survivant::class)]
    private $survivantsOrange1;

    #[ORM\OneToMany(mappedBy: 'orangeskill2', targetEntity: Survivant::class)]
    private $survivantsOrange2;

    #[ORM\OneToMany(mappedBy: 'redskill1', targetEntity: Survivant::class)]
    private $survivantsRed1;

    #[ORM\OneToMany(mappedBy: 'redskill2', targetEntity: Survivant::class)]
    private $survivantsRed2;

    #[ORM\OneToMany(mappedBy: 'redskill3', targetEntity: Survivant::class)]
    private $survivantsRed3;

    public function __construct()
    {
        $this->survivantsBlue1 = new ArrayCollection();
        $this->survivantsBlue2 = new ArrayCollection();
        $this->survivantsYellow = new ArrayCollection();
        $this->survivantsOrange1 = new ArrayCollection();
        $this->survivantsOrange2 = new ArrayCollection();
        $this->survivantsRed1 = new ArrayCollection();
        $this->survivantsRed2 = new ArrayCollection();
        $this->survivantsRed3 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSkillName(): ?string
    {
        return $this->skillName;
    }

    public function setSkillName(string $skillName): self
    {
        $this->skillName = $skillName;

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

    /**
     * @return Collection<int, Survivant>
     */
    public function getSurvivantsBlue1(): Collection
    {
        return $this->survivantsBlue1;
    }

    public function addSurvivantsBlue1(Survivant $survivantsBlue1): self
    {
        if (!$this->survivantsBlue1->contains($survivantsBlue1)) {
            $this->survivantsBlue1[] = $survivantsBlue1;
            $survivantsBlue1->setBlueskill1($this);
        }

        return $this;
    }

    public function removeSurvivantsBlue1(Survivant $survivantsBlue1): self
    {
        if ($this->survivantsBlue1->removeElement($survivantsBlue1)) {
            // set the owning side to null (unless already changed)
            if ($survivantsBlue1->getBlueskill1() === $this) {
                $survivantsBlue1->setBlueskill1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Survivant>
     */
    public function getSurvivantsBlue2(): Collection
    {
        return $this->survivantsBlue2;
    }

    public function addSurvivantsBlue2(Survivant $survivantsBlue2): self
    {
        if (!$this->survivantsBlue2->contains($survivantsBlue2)) {
            $this->survivantsBlue2[] = $survivantsBlue2;
            $survivantsBlue2->setBlueskill2($this);
        }

        return $this;
    }

    public function removeSurvivantsBlue2(Survivant $survivantsBlue2): self
    {
        if ($this->survivantsBlue2->removeElement($survivantsBlue2)) {
            // set the owning side to null (unless already changed)
            if ($survivantsBlue2->getBlueskill2() === $this) {
                $survivantsBlue2->setBlueskill2(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Survivant>
     */
    public function getSurvivantsYellow(): Collection
    {
        return $this->survivantsYellow;
    }

    public function addSurvivantsYellow(Survivant $survivantsYellow): self
    {
        if (!$this->survivantsYellow->contains($survivantsYellow)) {
            $this->survivantsYellow[] = $survivantsYellow;
            $survivantsYellow->setYellowskill($this);
        }

        return $this;
    }

    public function removeSurvivantsYellow(Survivant $survivantsYellow): self
    {
        if ($this->survivantsYellow->removeElement($survivantsYellow)) {
            // set the owning side to null (unless already changed)
            if ($survivantsYellow->getYellowskill() === $this) {
                $survivantsYellow->setYellowskill(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Survivant>
     */
    public function getSurvivantsOrange1(): Collection
    {
        return $this->survivantsOrange1;
    }

    public function addSurvivantsOrange1(Survivant $survivantsOrange1): self
    {
        if (!$this->survivantsOrange1->contains($survivantsOrange1)) {
            $this->survivantsOrange1[] = $survivantsOrange1;
            $survivantsOrange1->setOrangeskill1($this);
        }

        return $this;
    }

    public function removeSurvivantsOrange1(Survivant $survivantsOrange1): self
    {
        if ($this->survivantsOrange1->removeElement($survivantsOrange1)) {
            // set the owning side to null (unless already changed)
            if ($survivantsOrange1->getOrangeskill1() === $this) {
                $survivantsOrange1->setOrangeskill1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Survivant>
     */
    public function getSurvivantsOrange2(): Collection
    {
        return $this->survivantsOrange2;
    }

    public function addSurvivantsOrange2(Survivant $survivantsOrange2): self
    {
        if (!$this->survivantsOrange2->contains($survivantsOrange2)) {
            $this->survivantsOrange2[] = $survivantsOrange2;
            $survivantsOrange2->setOrangeskill2($this);
        }

        return $this;
    }

    public function removeSurvivantsOrange2(Survivant $survivantsOrange2): self
    {
        if ($this->survivantsOrange2->removeElement($survivantsOrange2)) {
            // set the owning side to null (unless already changed)
            if ($survivantsOrange2->getOrangeskill2() === $this) {
                $survivantsOrange2->setOrangeskill2(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Survivant>
     */
    public function getSurvivantsRed1(): Collection
    {
        return $this->survivantsRed1;
    }

    public function addSurvivantsRed1(Survivant $survivantsRed1): self
    {
        if (!$this->survivantsRed1->contains($survivantsRed1)) {
            $this->survivantsRed1[] = $survivantsRed1;
            $survivantsRed1->setRedskill1($this);
        }

        return $this;
    }

    public function removeSurvivantsRed1(Survivant $survivantsRed1): self
    {
        if ($this->survivantsRed1->removeElement($survivantsRed1)) {
            // set the owning side to null (unless already changed)
            if ($survivantsRed1->getRedskill1() === $this) {
                $survivantsRed1->setRedskill1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Survivant>
     */
    public function getSurvivantsRed2(): Collection
    {
        return $this->survivantsRed2;
    }

    public function addSurvivantsRed2(Survivant $survivantsRed2): self
    {
        if (!$this->survivantsRed2->contains($survivantsRed2)) {
            $this->survivantsRed2[] = $survivantsRed2;
            $survivantsRed2->setRedskill2($this);
        }

        return $this;
    }

    public function removeSurvivantsRed2(Survivant $survivantsRed2): self
    {
        if ($this->survivantsRed2->removeElement($survivantsRed2)) {
            // set the owning side to null (unless already changed)
            if ($survivantsRed2->getRedskill2() === $this) {
                $survivantsRed2->setRedskill2(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Survivant>
     */
    public function getSurvivantsRed3(): Collection
    {
        return $this->survivantsRed3;
    }

    public function addSurvivantsRed3(Survivant $survivantsRed3): self
    {
        if (!$this->survivantsRed3->contains($survivantsRed3)) {
            $this->survivantsRed3[] = $survivantsRed3;
            $survivantsRed3->setRedskill3($this);
        }

        return $this;
    }

    public function removeSurvivantsRed3(Survivant $survivantsRed3): self
    {
        if ($this->survivantsRed3->removeElement($survivantsRed3)) {
            // set the owning side to null (unless already changed)
            if ($survivantsRed3->getRedskill3() === $this) {
                $survivantsRed3->setRedskill3(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->skillName;
    }
}
