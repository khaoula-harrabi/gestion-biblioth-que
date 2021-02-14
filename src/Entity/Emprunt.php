<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmpruntRepository::class)
 */
class Emprunt
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $date;

    /**
     * @ORM\Column(type="string")
     */
    private $dateRetour;

    /**
     * @ORM\ManyToMany(targetEntity=Livre::class, inversedBy="emprunts")
     */
    private $emprunt_livre;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="emprunts")
     */
    private $utilisateur;

    public function __construct()
    {
        $this->emprunt_livre = new ArrayCollection();
        $this->utilisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDateRetour(): ?string
    {
        return $this->dateRetour;

    }

    public function setDateRetour(string $dateRetour): self
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    /**
     * @return Collection|Livre[]
     */
    public function getEmpruntLivre(): Collection
    {
        return $this->emprunt_livre;
    }

    public function addEmpruntLivre(Livre $empruntLivre): self
    {
        if (!$this->emprunt_livre->contains($empruntLivre)) {
            $this->emprunt_livre[] = $empruntLivre;
        }

        return $this;
    }

    public function removeEmpruntLivre(Livre $empruntLivre): self
    {
        $this->emprunt_livre->removeElement($empruntLivre);

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUtilisateur(): Collection
    {
        return $this->utilisateur;
    }

    public function addUtilisateur(User $utilisateur): self
    {
        if (!$this->utilisateur->contains($utilisateur)) {
            $this->utilisateur[] = $utilisateur;
        }

        return $this;
    }

    public function removeUtilisateur(User $utilisateur): self
    {
        $this->utilisateur->removeElement($utilisateur);

        return $this;
    }
}
