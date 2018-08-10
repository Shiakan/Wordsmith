<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="playerOne", cascade={"persist", "remove"})
     */
    private $playerOne;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="playerTwo", cascade={"persist", "remove"})
     */
    private $playerTwo;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="playerThree", cascade={"persist", "remove"})
     */
    private $playerThree;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="playerFour", cascade={"persist", "remove"})
     */
    private $playerFour;

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

    public function getPlayerOne(): ?User
    {
        return $this->playerOne;
    }

    public function setPlayerOne(?User $playerOne): self
    {
        $this->playerOne = $playerOne;

        return $this;
    }

    public function getPlayerTwo(): ?User
    {
        return $this->playerTwo;
    }

    public function setPlayerTwo(?User $playerTwo): self
    {
        $this->playerTwo = $playerTwo;

        return $this;
    }

    public function getPlayerThree(): ?User
    {
        return $this->playerThree;
    }

    public function setPlayerThree(?User $playerThree): self
    {
        $this->playerThree = $playerThree;

        return $this;
    }

    public function getPlayerFour(): ?User
    {
        return $this->playerFour;
    }

    public function setPlayerFour(?User $playerFour): self
    {
        $this->playerFour = $playerFour;

        return $this;
    }
}
