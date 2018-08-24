<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Thread", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $thread;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subcategory", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subcategory;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Thread", mappedBy="lastPost", cascade={"persist", "remove"})
     */
    private $topic;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Subcategory", mappedBy="lastPost", cascade={"persist", "remove"})
     */
    private $forum;

    public function __construct()
    {
        $this->status = 1;
        $this->createdAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getThread(): ?Thread
    {
        return $this->thread;
    }

    public function setThread(?Thread $thread): self
    {
        $this->thread = $thread;

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

    public function getSubcategory(): ?Subcategory
    {
        return $this->subcategory;
    }

    public function setSubcategory(?Subcategory $subcategory): self
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    public function getTopic(): ?Thread
    {
        return $this->topic;
    }

    public function setTopic(Thread $topic): self
    {
        $this->topic = $topic;

        // set the owning side of the relation if necessary
        if ($this !== $topic->getLastPost()) {
            $topic->setLastPost($this);
        }

        return $this;
    }

    public function getForum(): ?Subcategory
    {
        return $this->forum;
    }

    public function setForum(?Subcategory $forum): self
    {
        $this->forum = $forum;

        // set (or unset) the owning side of the relation if necessary
        $newLastPost = $forum === null ? null : $this;
        if ($newLastPost !== $forum->getLastPost()) {
            $forum->setLastPost($newLastPost);
        }

        return $this;
    }
}
