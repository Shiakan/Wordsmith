<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ThreadRepository")
 */
class Thread
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
    private $title;
    /**
     * @ORM\Column(type="string", length=256, nullable=true)
     */
    private $subtitle;
    /**
     * @ORM\Column(type="boolean")
     */
    private $status;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="thread")
     */
    private $posts;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subcategory", inversedBy="threads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subcategory;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="threads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HasReadThread", mappedBy="thread")
     */
    private $hasReadThreads;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Post", inversedBy="topic", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $lastPost;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;
    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->status = 1;
        $this->createdAt = new \DateTime();
        $this->hasReadThreads = new ArrayCollection();
    }
    public function getId()
    {
        return $this->id;
    }
    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }
    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }
    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;
        return $this;
    }
    public function getStatus(): ?bool
    {
        return $this->status;
    }
    public function setStatus(bool $status): self
    {
        $this->status = $status;
        return $this;
    }
    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }
    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setThread($this);
        }
        return $this;
    }
    public function removePost(Post $post): self
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            // set the owning side to null (unless already changed)
            if ($post->getThread() === $this) {
                $post->setThread(null);
            }
        }
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
    public function getAuthor(): ?User
    {
        return $this->author;
    }
    public function setAuthor(?User $author): self
    {
        $this->author = $author;
        return $this;
    }
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * @return Collection|HasReadThread[]
     */
    public function getHasReadThreads(): Collection
    {
        return $this->hasReadThreads;
    }
    public function addHasReadThread(HasReadThread $hasReadThread): self
    {
        if (!$this->hasReadThreads->contains($hasReadThread)) {
            $this->hasReadThreads[] = $hasReadThread;
            $hasReadThread->setThread($this);
        }
        return $this;
    }
    public function removeHasReadThread(HasReadThread $hasReadThread): self
    {
        if ($this->hasReadThreads->contains($hasReadThread)) {
            $this->hasReadThreads->removeElement($hasReadThread);
            // set the owning side to null (unless already changed)
            if ($hasReadThread->getThread() === $this) {
                $hasReadThread->setThread(null);
            }
        }
        return $this;
    }
    public function __toString()
    {
        return $this->title;
        return $this->subtitle;
    }

    public function getLastPost(): ?Post
    {
        return $this->lastPost;
    }

    public function setLastPost(Post $lastPost): self
    {
        $this->lastPost = $lastPost;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}