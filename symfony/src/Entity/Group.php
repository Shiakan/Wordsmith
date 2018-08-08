<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupRepository")
 */
class Group
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterProfile", mappedBy="groupForum")
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

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
            $character->setGroupForum($this);
        }

        return $this;
    }

    public function removeCharacter(CharacterProfile $character): self
    {
        if ($this->characters->contains($character)) {
            $this->characters->removeElement($character);
            // set the owning side to null (unless already changed)
            if ($character->getGroupForum() === $this) {
                $character->setGroupForum(null);
            }
        }

        return $this;
    }
}
