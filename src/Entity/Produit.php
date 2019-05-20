<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Produit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string", length=50, nullable=false)
     */
    private $libelle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Aeroport", inversedBy="idProduit")
     * @ORM\JoinTable(name="stockaeroport",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_Produit", referencedColumnName="id_Produit")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_Aeroport", referencedColumnName="id_Aeroport")
     *   }
     * )
     */
    private $idAeroport;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Avion", inversedBy="idProduit")
     * @ORM\JoinTable(name="stockavion",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_Produit", referencedColumnName="id_Produit")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_Avion", referencedColumnName="id_Avion")
     *   }
     * )
     */
    private $idAvion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idAeroport = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idAvion = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Aeroport[]
     */
    public function getIdAeroport(): Collection
    {
        return $this->idAeroport;
    }

    public function addIdAeroport(Aeroport $idAeroport): self
    {
        if (!$this->idAeroport->contains($idAeroport)) {
            $this->idAeroport[] = $idAeroport;
        }

        return $this;
    }

    public function removeIdAeroport(Aeroport $idAeroport): self
    {
        if ($this->idAeroport->contains($idAeroport)) {
            $this->idAeroport->removeElement($idAeroport);
        }

        return $this;
    }

    /**
     * @return Collection|Avion[]
     */
    public function getIdAvion(): Collection
    {
        return $this->idAvion;
    }

    public function addIdAvion(Avion $idAvion): self
    {
        if (!$this->idAvion->contains($idAvion)) {
            $this->idAvion[] = $idAvion;
        }

        return $this;
    }

    public function removeIdAvion(Avion $idAvion): self
    {
        if ($this->idAvion->contains($idAvion)) {
            $this->idAvion->removeElement($idAvion);
        }

        return $this;
    }

}
