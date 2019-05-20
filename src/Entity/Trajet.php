<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trajet
 *
 * @ORM\Table(name="trajet", indexes={@ORM\Index(name="codeA", columns={"codeA"}), @ORM\Index(name="codeD", columns={"codeD"})})
 * @ORM\Entity
 */
class Trajet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Trajet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTrajet;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_Trajet", type="string", length=50, nullable=false)
     */
    private $nomTrajet;

    /**
     * @var int
     *
     * @ORM\Column(name="distance", type="integer", nullable=false)
     */
    private $distance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="temps", type="time", nullable=false)
     */
    private $temps;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var \Aeroport
     *
     * @ORM\ManyToOne(targetEntity="Aeroport")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codeA", referencedColumnName="id_Aeroport")
     * })
     */
    private $codea;

    /**
     * @var \Aeroport
     *
     * @ORM\ManyToOne(targetEntity="Aeroport")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codeD", referencedColumnName="id_Aeroport")
     * })
     */
    private $coded;

    public function getIdTrajet(): ?int
    {
        return $this->idTrajet;
    }

    public function getNomTrajet(): ?string
    {
        return $this->nomTrajet;
    }

    public function setNomTrajet(string $nomTrajet): self
    {
        $this->nomTrajet = $nomTrajet;

        return $this;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getTemps(): ?\DateTimeInterface
    {
        return $this->temps;
    }

    public function setTemps(\DateTimeInterface $temps): self
    {
        $this->temps = $temps;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCodea(): ?Aeroport
    {
        return $this->codea;
    }

    public function setCodea(?Aeroport $codea): self
    {
        $this->codea = $codea;

        return $this;
    }

    public function getCoded(): ?Aeroport
    {
        return $this->coded;
    }

    public function setCoded(?Aeroport $coded): self
    {
        $this->coded = $coded;

        return $this;
    }


}
