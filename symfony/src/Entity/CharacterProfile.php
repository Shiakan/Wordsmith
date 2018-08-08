<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterProfileRepository")
 */
class CharacterProfile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $race;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $class;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $socialCast;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $localisation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $miscellaneous;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link2;

    public function getId()
    {
        return $this->id;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(?string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(?string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(?string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getSocialCast(): ?string
    {
        return $this->socialCast;
    }

    public function setSocialCast(?string $socialCast): self
    {
        $this->socialCast = $socialCast;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(?string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getMiscellaneous(): ?string
    {
        return $this->miscellaneous;
    }

    public function setMiscellaneous(?string $miscellaneous): self
    {
        $this->miscellaneous = $miscellaneous;

        return $this;
    }

    public function getLink1(): ?string
    {
        return $this->link1;
    }

    public function setLink1(?string $link1): self
    {
        $this->link1 = $link1;

        return $this;
    }

    public function getLink2(): ?string
    {
        return $this->link2;
    }

    public function setLink2(?string $link2): self
    {
        $this->link2 = $link2;

        return $this;
    }
}
