<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Voyage
 *
 * @ORM\Table(name="voyage")
 * @ORM\Entity(repositoryClass="App\Repository\VoyageRepository")
 */
class Voyage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Voyage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVoyage;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=50, nullable=false)
     */
    private $libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false, options={"default" : 0})
     */
    private $prix;

    /**
     * @var bool
     *
     * @ORM\Column(name="escale", type="boolean", nullable=false)
     */
    private $escale;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Vol", inversedBy="idVoyage")
     * @ORM\JoinTable(name="vol_voyage",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_Voyage", referencedColumnName="id_Voyage", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_Vol", referencedColumnName="id_Vol", onDelete="CASCADE")
     *   }
     * )
     */
    private $idVol;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Billet", mappedBy="id_Voyage")
     */
    private $billets;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idVol = new \Doctrine\Common\Collections\ArrayCollection();
        $this->billets = new ArrayCollection();
    }

    public function getIdVoyage(): ?int
    {
        return $this->idVoyage;
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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getEscale(): ?bool
    {
        return $this->escale;
    }

    public function setEscale(bool $escale): self
    {
        $this->escale = $escale;

        return $this;
    }

    /**
     * @return Collection|Vol[]
     */
    public function getIdVol(): Collection
    {
        return $this->idVol;
    }

    public function addIdVol(Vol $idVol): self
    {
        if (!$this->idVol->contains($idVol)) {
            $this->idVol[] = $idVol;
        }

        return $this;
    }

    public function removeIdVol(Vol $idVol): self
    {
        if ($this->idVol->contains($idVol)) {
            $this->idVol->removeElement($idVol);
        }

        return $this;
    }

    /**
     * @return Collection|Billet[]
     */
    public function getBillets(): Collection
    {
        return $this->billets;
    }

    public function addBillet(Billet $billet): self
    {
        if (!$this->billets->contains($billet)) {
            $this->billets[] = $billet;
            $billet->setIdVoyage($this);
        }

        return $this;
    }

    public function removeBillet(Billet $billet): self
    {
        if ($this->billets->contains($billet)) {
            $this->billets->removeElement($billet);
            // set the owning side to null (unless already changed)
            if ($billet->getIdVoyage() === $this) {
                $billet->setIdVoyage(null);
            }
        }

        return $this;
    }

}
