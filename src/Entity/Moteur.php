<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moteur
 *
 * @ORM\Table(name="moteur")
 * @ORM\Entity
 */
class Moteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Moteur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMoteur;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string", length=50, nullable=false)
     */
    private $libelle;

    public function getIdMoteur(): ?int
    {
        return $this->idMoteur;
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


}
