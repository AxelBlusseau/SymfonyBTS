<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaintenanceRepository")
 */
class Maintenance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(name="date_Debut", type="date")
     */
    private $date_Debut;

    /**
     * @ORM\Column(name="date_Fin", type="date")
     */
    private $date_Fin;

    /**
     * @ORM\Column(name="date_FinReelle", type="datetime", nullable=true)
     */
    private $date_FinReelle;

    /**
     * @ORM\Column(name="IsFinished", type="boolean")
     */
    private $IsFinished;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Incident")
     * @ORM\JoinColumn(name="id_Incident", nullable=false, onDelete="CASCADE")
     */
    private $id_Incident;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Employe")
     * @ORM\JoinTable(name="employe_maintenance",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_Maintenance", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_Employe", referencedColumnName="id_Employe")
     *   }
     * )
     */
    private $id_Employe;

    public function __construct()
    {
        $this->id_Employe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_Debut;
    }

    public function setDateDebut(\DateTimeInterface $date_Debut): self
    {
        $this->date_Debut = $date_Debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_Fin;
    }

    public function setDateFin(\DateTimeInterface $date_Fin): self
    {
        $this->date_Fin = $date_Fin;

        return $this;
    }

    public function getDateFinReelle(): ?\DateTimeInterface
    {
        return $this->date_FinReelle;
    }

    public function setDateFinReelle(?\DateTimeInterface $date_FinReelle): self
    {
        $this->date_FinReelle = $date_FinReelle;

        return $this;
    }

    public function getIsFinished(): ?bool
    {
        return $this->IsFinished;
    }

    public function setIsFinished(bool $IsFinished): self
    {
        $this->IsFinished = $IsFinished;

        return $this;
    }

    public function getIdIncident(): ?Incident
    {
        return $this->id_Incident;
    }

    public function setIdIncident(?Incident $id_Incident): self
    {
        $this->id_Incident = $id_Incident;

        return $this;
    }

    /**
     * @return Collection|Employe[]
     */
    public function getIdEmploye(): Collection
    {
        return $this->id_Employe;
    }

    public function addIdEmploye(Employe $idEmploye): self
    {
        if (!$this->id_Employe->contains($idEmploye)) {
            $this->id_Employe[] = $idEmploye;
        }

        return $this;
    }

    public function removeIdEmploye(Employe $idEmploye): self
    {
        if ($this->id_Employe->contains($idEmploye)) {
            $this->id_Employe->removeElement($idEmploye);
        }

        return $this;
    }
}
