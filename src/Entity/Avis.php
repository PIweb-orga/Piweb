<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis", indexes={@ORM\Index(name="iduser", columns={"iduser"}), @ORM\Index(name="id_resto", columns={"id_restau"})})
 * @ORM\Entity
 */
class Avis
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="pubAvis", type="string", length=2000, nullable=false)
     */
    private $pubavis;

    /**
     * @var string
     *
     * @ORM\Column(name="titreAvis", type="string", length=30, nullable=false)
     */
    private $titreavis;

    /**
     * @var string
     *
     * @ORM\Column(name="dateAvis", type="string", length=20, nullable=false)
     */
    private $dateavis;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iduser", referencedColumnName="iduser")
     * })
     */
    private $iduser;

    /**
     * @var \Restaurant
     *
     * @ORM\ManyToOne(targetEntity="Restaurant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_restau", referencedColumnName="id_restau")
     * })
     */
    private $idRestau;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPubavis(): ?string
    {
        return $this->pubavis;
    }

    public function setPubavis(string $pubavis): static
    {
        $this->pubavis = $pubavis;

        return $this;
    }

    public function getTitreavis(): ?string
    {
        return $this->titreavis;
    }

    public function setTitreavis(string $titreavis): static
    {
        $this->titreavis = $titreavis;

        return $this;
    }

    public function getDateavis(): ?string
    {
        return $this->dateavis;
    }

    public function setDateavis(string $dateavis): static
    {
        $this->dateavis = $dateavis;

        return $this;
    }

    public function getIduser(): ?User
    {
        return $this->iduser;
    }

    public function setIduser(?User $iduser): static
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getIdRestau(): ?Restaurant
    {
        return $this->idRestau;
    }

    public function setIdRestau(?Restaurant $idRestau): static
    {
        $this->idRestau = $idRestau;

        return $this;
    }


}
