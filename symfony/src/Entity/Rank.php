<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RankRepository")
 */
class Rank
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=256)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterProfile", mappedBy="rank")
     */
    private $characters;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
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

    /**
     * @return Collection|CharacterProfile[]
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(CharacterProfile $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters[] = $character;
            $character->setRank($this);
        }

        return $this;
    }

    public function removeCharacter(CharacterProfile $character): self
    {
        if ($this->characters->contains($character)) {
            $this->characters->removeElement($character);
            // set the owning side to null (unless already changed)
            if ($character->getRank() === $this) {
                $character->setRank(null);
            }
        }

        return $this;
    }
}
