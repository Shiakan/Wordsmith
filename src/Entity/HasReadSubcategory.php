<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HasReadSubcategoryRepository")
 */
class HasReadSubcategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $threadCount;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="hasReadSubcategories")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subcategory", inversedBy="hasReadSubcategories")
     */
    private $subcategory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getThreadCount(): ?int
    {
        return $this->threadCount;
    }

    public function setThreadCount(?int $threadCount): self
    {
        $this->threadCount = $threadCount;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSubcategory(): ?Subcategory
    {
        return $this->subcategory;
    }

    public function setSubcategory(?Subcategory $subcategory): self
    {
        $this->subcategory = $subcategory;

        return $this;
    }
}
