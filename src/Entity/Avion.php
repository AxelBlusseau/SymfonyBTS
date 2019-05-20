<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Avion
 *
 * @ORM\Table(name="avion", indexes={@ORM\Index(name="id_Aeroport_Actuel", columns={"id_Aeroport_Actuel"}), @ORM\Index(name="id_Modele", columns={"id_Modele"})})
 * @ORM\Entity(repositoryClass="App\Repository\AvionRepository")
 */
class Avion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Avion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAvion;

    /**
     * @var int
     *
     * @ORM\Column(name="Capacite", type="integer", nullable=false)
     */
    private $capacite;

    /**
     * @var int
     *
     * @ORM\Column(name="Kilometrage", type="integer", nullable=false, options={"default" : 0})
     */
    private $kilometrage;

    /**
     * @var bool
     *
     * @ORM\Column(name="Disponibilite", type="boolean", nullable=false,  options={"default" : 0})
     */
    private $disponibilite;

    /**
     * @var \Aeroport
     *
     * @ORM\ManyToOne(targetEntity="Aeroport")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Aeroport_Actuel", referencedColumnName="id_Aeroport")
     * })
     */
    private $idAeroportActuel;

    /**
     * @var \Modele
     *
     * @ORM\ManyToOne(targetEntity="Modele")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Modele", referencedColumnName="id_Modele")
     * })
     */
    private $idModele;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="idAvion")
     */
    private $idProduit;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idProduit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdAvion(): ?int
    {
        return $this->idAvion;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(bool $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getIdAeroportActuel(): ?Aeroport
    {
        return $this->idAeroportActuel;
    }

    public function setIdAeroportActuel(?Aeroport $idAeroportActuel): self
    {
        $this->idAeroportActuel = $idAeroportActuel;

        return $this;
    }

    public function getIdModele(): ?Modele
    {
        return $this->idModele;
    }

    public function setIdModele(?Modele $idModele): self
    {
        $this->idModele = $idModele;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getIdProduit(): Collection
    {
        return $this->idProduit;
    }

    public function addIdProduit(Produit $idProduit): self
    {
        if (!$this->idProduit->contains($idProduit)) {
            $this->idProduit[] = $idProduit;
            $idProduit->addIdAvion($this);
        }

        return $this;
    }

    public function removeIdProduit(Produit $idProduit): self
    {
        if ($this->idProduit->contains($idProduit)) {
            $this->idProduit->removeElement($idProduit);
            $idProduit->removeIdAvion($this);
        }

        return $this;
    }

}
