<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Entrez un nom pour le produit")
     * @Assert\Length(max=50, min=3)
     * @ORM\Column(type="string", length=50)
     */
    private $Libelle;

    /**
     * @Assert\NotBlank(message="Entrez une référence pour le produit")
     * @Assert\Length(max=10)
     * @ORM\Column(type="string", length=10)
     */
    private $Reference;

    /**
     * @Assert\NotBlank(message="Entrez un prix pour le produit")
     * @ORM\Column(type="float")
     */
    private $Prix;

    /**
     * @Assert\NotBlank(message="Entrez une quantité pour le produit")
     * @ORM\Column(type="integer")
     */
    private $Stock;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="date")
     */
    private $DateAjout;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="produit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->Reference;
    }

    public function setReference(string $Reference): self
    {
        $this->Reference = $Reference;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->Stock;
    }

    public function setStock(int $Stock): self
    {
        $this->Stock = $Stock;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->DateAjout;
    }

    public function setDateAjout(\DateTimeInterface $DateAjout): self
    {
        $this->DateAjout = $DateAjout;

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
}
