<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
* @ORM\Table(name="app_user")
* @ORM\Entity(repositoryClass="App\Repository\UserRepository")
* @UniqueEntity(
     * fields={"email"},
     * errorPath="email",  
     * message="Cet email est déjà pris")
* @UniqueEntity(
     * fields={"username"},
     * errorPath="username",  
     * message="Ce nom d'utilisateur est déjà pris")
*/
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=64, unique=true)
     */
    private $username;
    /**
     * @ORM\Column(type="string", length=128, unique=true)
     * @Assert\Email()
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=256)
     */
    private $password;
    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="date")
     *  
     * @Assert\LessThan("-16 years",
     * message="Vous devez avoir au minimum 16 ans pour vous inscrire !")
     */
    private $birthdate;
    /**
     * @ORM\Column(type="datetime")
     */
    private $dateInserted;
    /**
     * @ORM\Column(type="datetime")
     */
    private $dateUpdated;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="author", orphanRemoval=true)
     */
    private $articles;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="author", orphanRemoval=true)
     */
    private $comments;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="author")
     */
    private $posts;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Thread", mappedBy="author")
     */
    private $threads;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Room", mappedBy="dungeonmaster", orphanRemoval=true)
     */
    private $rooms;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Charactersheet", mappedBy="user", cascade={"persist", "remove"})
     */
    private $charactersheet;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CharacterProfile", mappedBy="user", cascade={"persist", "remove"})
     */
    private $characterProfile;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Room", mappedBy="participants")
     */
    private $playerRooms;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HasReadThread", mappedBy="user")
     */
    private $hasReadThreads;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HasReadSubcategory", mappedBy="user")
     */
    private $hasReadSubcategories;
    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->threads = new ArrayCollection();
        $this->rooms = new ArrayCollection();
        $this->isActive = 1;
        $this->dateInserted = new \DateTime();
        $this->dateUpdated = new \DateTime();
        $this->playerRooms = new ArrayCollection();
        $this->hasReadThreads = new ArrayCollection();
        $this->hasReadSubcategories = new ArrayCollection();
    }
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }
    public function eraseCredentials()
    {
    }
    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }
    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized, array('allowed_classes' => false));
    }
    public function getId()
    {
        return $this->id;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
    public function getPassword()
   {
       return $this->password;
   }
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }
    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }
    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;
        return $this;
    }
    public function getDateInserted(): ?\DateTimeInterface
    {
        return $this->dateInserted;
    }
    public function setDateInserted(\DateTimeInterface $dateInserted): self
    {
        $this->dateInserted = $dateInserted;
        return $this;
    }
    public function getDateUpdated(): ?\DateTimeInterface
    {
        return $this->dateUpdated;
    }
    public function setDateUpdated(\DateTimeInterface $dateUpdated): self
    {
        $this->dateUpdated = $dateUpdated;
        return $this;
    }
    public function getRoles()
   {
       return array($this->getRole()->getCode());
   }
    public function getRole()
    {
        return $this->role;
    }
    public function setRole(?Role $role): self
    {
        $this->role = $role;
        return $this;
    }
    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }
    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setAuthor($this);
        }
        return $this;
    }
    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getAuthor() === $this) {
                $article->setAuthor(null);
            }
        }
        return $this;
    }
    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }
    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setAuthor($this);
        }
        return $this;
    }
    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }
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
            $post->setAuthor($this);
        }
        return $this;
    }
    public function removePost(Post $post): self
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            // set the owning side to null (unless already changed)
            if ($post->getAuthor() === $this) {
                $post->setAuthor(null);
            }
        }
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
            $thread->setAuthor($this);
        }
        return $this;
    }
    public function removeThread(Thread $thread): self
    {
        if ($this->threads->contains($thread)) {
            $this->threads->removeElement($thread);
            // set the owning side to null (unless already changed)
            if ($thread->getAuthor() === $this) {
                $thread->setAuthor(null);
            }
        }
        return $this;
    }
    /**
     * @return Collection|Room[]
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }
    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setDungeonmaster($this);
        }
        return $this;
    }
    public function removeRoom(Room $room): self
    {
        if ($this->rooms->contains($room)) {
            $this->rooms->removeElement($room);
            // set the owning side to null (unless already changed)
            if ($room->getDungeonmaster() === $this) {
                $room->setDungeonmaster(null);
            }
        }
        return $this;
    }
    public function __toString(){
        return $this->username;
        }
    public function getCharactersheet(): ?Charactersheet
    {
        return $this->charactersheet;
    }
    public function setCharactersheet(Charactersheet $charactersheet): self
    {
        $this->charactersheet = $charactersheet;
        // set the owning side of the relation if necessary
        if ($this !== $charactersheet->getUser()) {
            $charactersheet->setUser($this);
        }
        return $this;
    }
    public function getCharacterProfile(): ?CharacterProfile
    {
        return $this->characterProfile;
    }
    public function setCharacterProfile(CharacterProfile $characterProfile): self
    {
        $this->characterProfile = $characterProfile;
        // set the owning side of the relation if necessary
        if ($this !== $characterProfile->getUser()) {
            $characterProfile->setUser($this);
        }
        return $this;
    }
    /**
     * @return Collection|Room[]
     */
    public function getPlayerRooms(): Collection
    {
        return $this->playerRooms;
    }
    public function addPlayerRoom(Room $playerRoom): self
    {
        if (!$this->playerRooms->contains($playerRoom)) {
            $this->playerRooms[] = $playerRoom;
            $playerRoom->addParticipant($this);
        }
        return $this;
    }
    public function removePlayerRoom(Room $playerRoom): self
    {
        if ($this->playerRooms->contains($playerRoom)) {
            $this->playerRooms->removeElement($playerRoom);
            $playerRoom->removeParticipant($this);
        }
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
            $hasReadThread->setUser($this);
        }
        return $this;
    }
    public function removeHasReadThread(HasReadThread $hasReadThread): self
    {
        if ($this->hasReadThreads->contains($hasReadThread)) {
            $this->hasReadThreads->removeElement($hasReadThread);
            // set the owning side to null (unless already changed)
            if ($hasReadThread->getUser() === $this) {
                $hasReadThread->setUser(null);
            }
        }
        return $this;
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
            $hasReadSubcategory->setUser($this);
        }

        return $this;
    }

    public function removeHasReadSubcategory(HasReadSubcategory $hasReadSubcategory): self
    {
        if ($this->hasReadSubcategories->contains($hasReadSubcategory)) {
            $this->hasReadSubcategories->removeElement($hasReadSubcategory);
            // set the owning side to null (unless already changed)
            if ($hasReadSubcategory->getUser() === $this) {
                $hasReadSubcategory->setUser(null);
            }
        }

        return $this;
    }
}