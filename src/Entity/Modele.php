<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Modele
 *
 * @ORM\Table(name="modele", indexes={@ORM\Index(name="id_Moteur", columns={"id_Moteur"})})
 * @ORM\Entity
 */
class Modele
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Modele", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idModele;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string", length=50, nullable=false)
     */
    private $libelle;

    /**
     * @var \Moteur
     *
     * @ORM\ManyToOne(targetEntity="Moteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Moteur", referencedColumnName="id_Moteur")
     * })
     */
    private $idMoteur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="TypeCourrier", inversedBy="idModele")
     * @ORM\JoinTable(name="modele_courrier",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_Modele", referencedColumnName="id_Modele")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_Courrier", referencedColumnName="id_Courrier")
     *   }
     * )
     */
    private $idCourrier;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCourrier = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdModele(): ?int
    {
        return $this->idModele;
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

    public function getIdMoteur(): ?Moteur
    {
        return $this->idMoteur;
    }

    public function setIdMoteur(?Moteur $idMoteur): self
    {
        $this->idMoteur = $idMoteur;

        return $this;
    }

    /**
     * @return Collection|TypeCourrier[]
     */
    public function getIdCourrier(): Collection
    {
        return $this->idCourrier;
    }

    public function addIdCourrier(TypeCourrier $idCourrier): self
    {
        if (!$this->idCourrier->contains($idCourrier)) {
            $this->idCourrier[] = $idCourrier;
        }

        return $this;
    }

    public function removeIdCourrier(TypeCourrier $idCourrier): self
    {
        if ($this->idCourrier->contains($idCourrier)) {
            $this->idCourrier->removeElement($idCourrier);
        }

        return $this;
    }


}
