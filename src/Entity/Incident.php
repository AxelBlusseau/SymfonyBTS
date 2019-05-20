<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncidentRepository")
 */
class Incident
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Avion")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_Avion", referencedColumnName="id_Avion")
     * })
     */
    private $id_Avion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employe")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_Employe", referencedColumnName="id_Employe")
     * })
     */
    private $id_Employe;

    /**
     * @ORM\Column(type="text")
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(name="IsResolu", type="boolean")
     */
    private $IsResolu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAvion(): ?Avion
    {
        return $this->id_Avion;
    }

    public function setIdAvion(?Avion $id_Avion): self
    {
        $this->id_Avion = $id_Avion;

        return $this;
    }

    public function getIdEmploye(): ?Employe
    {
        return $this->id_Employe;
    }

    public function setIdEmploye(?Employe $id_Employe): self
    {
        $this->id_Employe = $id_Employe;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIsResolu(): ?bool
    {
        return $this->IsResolu;
    }

    public function setIsResolu(bool $IsResolu): self
    {
        $this->IsResolu = $IsResolu;

        return $this;
    }
}
