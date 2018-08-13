<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Count;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dungeonmaster;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="playerRooms")
     * @Assert\Count(
     *      min = 2,
     *      max = 4,
     *      minMessage = "Sélectionnez au moins 2 joueurs",
     *      maxMessage = "Vous ne pouvez pas sélectionner plus de 4 joueurs"
     * )
     */
    private $participants;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDungeonmaster(): ?User
    {
        return $this->dungeonmaster;
    }

    public function setDungeonmaster(?User $dungeonmaster): self
    {
        $this->dungeonmaster = $dungeonmaster;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(User $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(User $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
        }

        return $this;
    }

    public function __toString(){
        return $this->participants;
        }

}
