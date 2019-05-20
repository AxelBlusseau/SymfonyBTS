<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Aeroport
 *
 * @ORM\Table(name="aeroport")
 * @ORM\Entity
 */
class Aeroport
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_Aeroport", type="string", length=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAeroport;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_Aeroport", type="string", length=50, nullable=false)
     */
    private $nomAeroport;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=50, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=50, nullable=false)
     */
    private $pays;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="idAeroport")
     */
    private $idProduit;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idProduit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdAeroport(): ?string
    {
        return $this->idAeroport;
    }

    public function getNomAeroport(): ?string
    {
        return $this->nomAeroport;
    }

    public function setNomAeroport(string $nomAeroport): self
    {
        $this->nomAeroport = $nomAeroport;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

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
            $idProduit->addIdAeroport($this);
        }

        return $this;
    }

    public function removeIdProduit(Produit $idProduit): self
    {
        if ($this->idProduit->contains($idProduit)) {
            $this->idProduit->removeElement($idProduit);
            $idProduit->removeIdAeroport($this);
        }

        return $this;
    }

}
