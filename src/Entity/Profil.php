<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfilRepository::class)]
class Profil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'profils')]
    private $player;

    #[ORM\ManyToOne(targetEntity: TableGame::class, inversedBy: 'profils')]
    private $tableParty;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?User
    {
        return $this->player;
    }

    public function setPlayer(?User $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getTableParty(): ?TableGame
    {
        return $this->tableParty;
    }

    public function setTableParty(?TableGame $tableParty): self
    {
        $this->tableParty = $tableParty;

        return $this;
    }
}
