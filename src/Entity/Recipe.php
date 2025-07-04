<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use App\Validator\InappropriateWords;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Traits\Timestampable;

   
#[ORM\Entity(repositoryClass: RecipeRepository::class)]
#[ORM\Table(name:"recipes")]
#[UniqueEntity('title')]//Add the UniqueEntity constraint para titro
class Recipe
{
 
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]//unique Add the unique constraint na base de donner 
    #[Assert\NotBlank()]
    #[Assert\Length(
    min:10,
    max:255)]
    // #[Assert\NotEqualTo("Merde",message: "Vous ne pouvez pas utiliser le mot grossier(M****)")]
    #[InappropriateWords()] // Add the InappropriateWords constraint
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 10, max: 1000)]
    private ?string $content = null;
    use Timestampable;
   
    #[ORM\Column(nullable: true)]
    #[Assert\Positive()]
    #[Assert\LessThan(300)]
    private ?int $duration = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $imageName = "https://upload.wikimedia.org/wikipedia/commons/thumb/d/da/Imagen_no_disponible.svg/600px-Imagen_no_disponible.svg.png";

    #[ORM\ManyToOne(inversedBy: 'recipes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }


    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): static
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
    private ?User $author = null;

public function getAuthor(): ?User
{
    return $this->author;
}

// public function setAuthor(?User $author): self
// {
//     $this->author = $author;
//     return $this;
// }
}
