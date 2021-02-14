<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 */
class Livre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbpages;

    /**
     * @ORM\Column(type="date")
     */
    private $dateedition;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbreexemplaires;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="bigint")
     */
    private $isbn;

    /**
     * @ORM\ManyToOne(targetEntity=Editeur::class, inversedBy="livres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $editeur;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="livres")
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity=Auteur::class, inversedBy="livres")
     */
    private $auteurs;

    /**
     * @ORM\ManyToMany(targetEntity=Abonnee::class, inversedBy="livres")
     */
    private $abonnes;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="livres", orphanRemoval=true , cascade={"persist"})
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity=Emprunt::class, mappedBy="emprunt_livre")
     */
    private $emprunts;


    public function __construct()
    {
        $this->auteurs = new ArrayCollection();
        $this->abonnes = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->emprunts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNbpages(): ?int
    {
        return $this->nbpages;
    }

    public function setNbpages(int $nbpages): self
    {
        $this->nbpages = $nbpages;

        return $this;
    }

    public function getDateedition(): ?\DateTimeInterface
    {
        return $this->dateedition;
    }

    public function setDateedition(\DateTimeInterface $dateedition): self
    {
        $this->dateedition = $dateedition;

        return $this;
    }

    public function getNbreexemplaires(): ?int
    {
        return $this->nbreexemplaires;
    }

    public function setNbreexemplaires(int $nbreexemplaires): self
    {
        $this->nbreexemplaires = $nbreexemplaires;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getEditeur(): ?Editeur
    {
        return $this->editeur;
    }

    public function setEditeur(?Editeur $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Auteur[]
     */
    public function getAuteurs(): Collection
    {
        return $this->auteurs;
    }

    public function addAuteur(Auteur $auteur): self
    {
        if (!$this->auteurs->contains($auteur)) {
            $this->auteurs[] = $auteur;
        }

        return $this;
    }

    public function removeAuteur(Auteur $auteur): self
    {
        $this->auteurs->removeElement($auteur);

        return $this;
    }

    /**
     * @return Collection|Abonnee[]
     */
    public function getAbonnes(): Collection
    {
        return $this->abonnes;
    }

    public function addAbonne(Abonnee $abonne): self
    {
        if (!$this->abonnes->contains($abonne)) {
            $this->abonnes[] = $abonne;
        }

        return $this;
    }

    public function removeAbonne(Abonnee $abonne): self
    {
        $this->abonnes->removeElement($abonne);

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setLivres($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getLivres() === $this) {
                $image->setLivres(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Emprunt[]
     */
    public function getEmprunts(): Collection
    {
        return $this->emprunts;
    }

    public function addEmprunt(Emprunt $emprunt): self
    {
        if (!$this->emprunts->contains($emprunt)) {
            $this->emprunts[] = $emprunt;
            $emprunt->addEmpruntLivre($this);
        }

        return $this;
    }

    public function removeEmprunt(Emprunt $emprunt): self
    {
        if ($this->emprunts->removeElement($emprunt)) {
            $emprunt->removeEmpruntLivre($this);
        }

        return $this;
    }



}
