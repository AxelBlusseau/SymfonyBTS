<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BilletRepository")
 */
class Billet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Voyage", inversedBy="billets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Voyage", referencedColumnName="id_Voyage")
     * })
     */
    private $id_Voyage;

    /**
     * @ORM\Column(type="date")
     */
    private $date_Achat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="billets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_Passager;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdVoyage(): ?Voyage
    {
        return $this->id_Voyage;
    }

    public function setIdVoyage(?Voyage $id_Voyage): self
    {
        $this->id_Voyage = $id_Voyage;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->date_Achat;
    }

    public function setDateAchat(\DateTimeInterface $date_Achat): self
    {
        $this->date_Achat = $date_Achat;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(string $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getIdPassager(): ?User
    {
        return $this->id_Passager;
    }

    public function setIdPassager(?User $id_Passager): self
    {
        $this->id_Passager = $id_Passager;

        return $this;
    }
}
