<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\SubcategoryRepository")
 */
class Subcategory
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="subcategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Thread", mappedBy="subcategory")
     */
    private $threads;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $reminder;
    /**
     * @ORM\Column(type="boolean")
     */
    private $isPrivate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HasReadSubcategory", mappedBy="subcategory")
     */
    private $hasReadSubcategories;

    public function __construct()
    {
        $this->threads = new ArrayCollection();
        $this->isPrivate = 0;
        $this->hasReadSubcategories = new ArrayCollection();
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
    public function getCategory(): ?Category
    {
        return $this->category;
    }
    public function setCategory(?Category $category): self
    {
        $this->category = $category;
        return $this;
    }
    /**
     * @return Collection|Thread[]
     */
    public function getThreads(): Collection
    {
        return $this->threads;
    }
    public function addThread(Thread $thread): self
    {
        if (!$this->threads->contains($thread)) {
            $this->threads[] = $thread;
            $thread->setSubcategory($this);
        }
        return $this;
    }
    public function removeThread(Thread $thread): self
    {
        if ($this->threads->contains($thread)) {
            $this->threads->removeElement($thread);
            // set the owning side to null (unless already changed)
            if ($thread->getSubcategory() === $this) {
                $thread->setSubcategory(null);
            }
        }
        return $this;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }
    public function getReminder(): ?string
    {
        return $this->reminder;
    }
    public function setReminder(?string $reminder): self
    {
        $this->reminder = $reminder;
        return $this;
    }
    public function getIsPrivate(): ?bool
    {
        return $this->isPrivate;
    }
    public function setIsPrivate(bool $isPrivate): self
    {
        $this->isPrivate = $isPrivate;
        return $this;
    }
    public function __toString(){
    return $this->name;
    }

    /**
     * @return Collection|HasReadSubcategory[]
     */
    public function getHasReadSubcategories(): Collection
    {
        return $this->hasReadSubcategories;
    }

    public function addHasReadSubcategory(HasReadSubcategory $hasReadSubcategory): self
    {
        if (!$this->hasReadSubcategories->contains($hasReadSubcategory)) {
            $this->hasReadSubcategories[] = $hasReadSubcategory;
            $hasReadSubcategory->setSubcategory($this);
        }

        return $this;
    }

    public function removeHasReadSubcategory(HasReadSubcategory $hasReadSubcategory): self
    {
        if ($this->hasReadSubcategories->contains($hasReadSubcategory)) {
            $this->hasReadSubcategories->removeElement($hasReadSubcategory);
            // set the owning side to null (unless already changed)
            if ($hasReadSubcategory->getSubcategory() === $this) {
                $hasReadSubcategory->setSubcategory(null);
            }
        }

        return $this;
    }
}