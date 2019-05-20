<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Vol
 *
 * @ORM\Table(name="vol", indexes={@ORM\Index(name="id_Trajet", columns={"id_Trajet"}), @ORM\Index(name="id_Avion", columns={"id_Avion"})})
 * @ORM\Entity(repositoryClass="App\Repository\VolRepository")
 */
class Vol
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Vol", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_Depart", type="date", nullable=false)
     */
    private $dateDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_Arrive", type="date", nullable=false)
     */
    private $dateArrive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_Depart", type="time", nullable=false)
     */
    private $heureDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_Arrive", type="time", nullable=false)
     */
    private $heureArrive;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_Depart_Reelle", type="date", nullable=true)
     */
    private $dateDepartReelle;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_Arrive_Reelle", type="date", nullable=true)
     */
    private $dateArriveReelle;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_Depart_Reelle", type="time", nullable=true)
     */
    private $heureDepartReelle;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_Arrive_Reelle", type="time", nullable=true)
     */
    private $heureArriveReelle;

    /**
     * @var \Trajet
     *
     * @ORM\ManyToOne(targetEntity="Trajet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Trajet", referencedColumnName="id_Trajet", onDelete="CASCADE")
     * })
     */
    private $idTrajet;

    /**
     * @var \Avion
     *
     * @ORM\ManyToOne(targetEntity="Avion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Avion", referencedColumnName="id_Avion")
     * })
     */
    private $idAvion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Voyage", mappedBy="idVol")
     */
    private $idVoyage;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idVoyage = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdVol(): ?int
    {
        return $this->idVol;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateArrive(): ?\DateTimeInterface
    {
        return $this->dateArrive;
    }

    public function setDateArrive(\DateTimeInterface $dateArrive): self
    {
        $this->dateArrive = $dateArrive;

        return $this;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(\DateTimeInterface $heureDepart): self
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    public function getHeureArrive(): ?\DateTimeInterface
    {
        return $this->heureArrive;
    }

    public function setHeureArrive(\DateTimeInterface $heureArrive): self
    {
        $this->heureArrive = $heureArrive;

        return $this;
    }

    public function getDateDepartReelle(): ?\DateTimeInterface
    {
        return $this->dateDepartReelle;
    }

    public function setDateDepartReelle(?\DateTimeInterface $dateDepartReelle): self
    {
        $this->dateDepartReelle = $dateDepartReelle;

        return $this;
    }

    public function getDateArriveReelle(): ?\DateTimeInterface
    {
        return $this->dateArriveReelle;
    }

    public function setDateArriveReelle(?\DateTimeInterface $dateArriveReelle): self
    {
        $this->dateArriveReelle = $dateArriveReelle;

        return $this;
    }

    public function getHeureDepartReelle(): ?\DateTimeInterface
    {
        return $this->heureDepartReelle;
    }

    public function setHeureDepartReelle(?\DateTimeInterface $heureDepartReelle): self
    {
        $this->heureDepartReelle = $heureDepartReelle;

        return $this;
    }

    public function getHeureArriveReelle(): ?\DateTimeInterface
    {
        return $this->heureArriveReelle;
    }

    public function setHeureArriveReelle(?\DateTimeInterface $heureArriveReelle): self
    {
        $this->heureArriveReelle = $heureArriveReelle;

        return $this;
    }

    public function getIdTrajet(): ?Trajet
    {
        return $this->idTrajet;
    }

    public function setIdTrajet(?Trajet $idTrajet): self
    {
        $this->idTrajet = $idTrajet;

        return $this;
    }

    public function getIdAvion(): ?Avion
    {
        return $this->idAvion;
    }

    public function setIdAvion(?Avion $idAvion): self
    {
        $this->idAvion = $idAvion;

        return $this;
    }

    /**
     * @return Collection|Voyage[]
     */
    public function getIdVoyage(): Collection
    {
        return $this->idVoyage;
    }

    public function addIdVoyage(Voyage $idVoyage): self
    {
        if (!$this->idVoyage->contains($idVoyage)) {
            $this->idVoyage[] = $idVoyage;
            $idVoyage->addIdVol($this);
        }

        return $this;
    }

    public function removeIdVoyage(Voyage $idVoyage): self
    {
        if ($this->idVoyage->contains($idVoyage)) {
            $this->idVoyage->removeElement($idVoyage);
            $idVoyage->removeIdVol($this);
        }

        return $this;
    }

}
