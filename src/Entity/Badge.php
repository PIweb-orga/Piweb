<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Badge
 *
 * @ORM\Table(name="badge", indexes={@ORM\Index(name="idrestau", columns={"id_restau"}), @ORM\Index(name="iduser", columns={"iduser"})})
 * @ORM\Entity
 */
class Badge
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
     * @ORM\Column(name="commantaire", type="string", length=2000, nullable=false)
     */
    private $commantaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateBadge", type="date", nullable=false)
     */
    private $datebadge;

    /**
     * @var string
     *
     * @ORM\Column(name="typeBadge", type="string", length=0, nullable=false)
     */
    private $typebadge;

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

    public function getCommantaire(): ?string
    {
        return $this->commantaire;
    }

    public function setCommantaire(string $commantaire): static
    {
        $this->commantaire = $commantaire;

        return $this;
    }

    public function getDatebadge(): ?\DateTimeInterface
    {
        return $this->datebadge;
    }

    public function setDatebadge(\DateTimeInterface $datebadge): static
    {
        $this->datebadge = $datebadge;

        return $this;
    }

    public function getTypebadge(): ?string
    {
        return $this->typebadge;
    }

    public function setTypebadge(string $typebadge): static
    {
        $this->typebadge = $typebadge;

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
