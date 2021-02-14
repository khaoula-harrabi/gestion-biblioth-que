<?php

namespace App\Entity;

use App\Repository\AbonneeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AbonneeRepository::class)
 */
class Abonnee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomabonne;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $pays;

    /**
     * @ORM\Column(type="bigint")
     */
    private $telephone;

    /**
     * @ORM\ManyToMany(targetEntity=Livre::class, mappedBy="abonnes")
     */
    private $livres;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomabonne(): ?string
    {
        return $this->nomabonne;
    }

    public function setNomabonne(string $nomabonne): self
    {
        $this->nomabonne = $nomabonne;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection|Livre[]
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): self
    {
        if (!$this->livres->contains($livre)) {
            $this->livres[] = $livre;
            $livre->addAbonne($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        if ($this->livres->removeElement($livre)) {
            $livre->removeAbonne($this);
        }

        return $this;
    }

}
