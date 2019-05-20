<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TypeCourrier
 *
 * @ORM\Table(name="type_courrier")
 * @ORM\Entity
 */
class TypeCourrier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Courrier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCourrier;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string", length=50, nullable=false, options={"fixed"=true})
     */
    private $libelle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Modele", mappedBy="idCourrier")
     */
    private $idModele;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idModele = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdCourrier(): ?int
    {
        return $this->idCourrier;
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
     * @return Collection|Modele[]
     */
    public function getIdModele(): Collection
    {
        return $this->idModele;
    }

    public function addIdModele(Modele $idModele): self
    {
        if (!$this->idModele->contains($idModele)) {
            $this->idModele[] = $idModele;
            $idModele->addIdCourrier($this);
        }

        return $this;
    }

    public function removeIdModele(Modele $idModele): self
    {
        if ($this->idModele->contains($idModele)) {
            $this->idModele->removeElement($idModele);
            $idModele->removeIdCourrier($this);
        }

        return $this;
    }

}
