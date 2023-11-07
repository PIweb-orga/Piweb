<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="reservattion_ibfk_1", columns={"id_restau"}), @ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_res", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datereser", type="date", nullable=false)
     */
    private $datereser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timereser", type="time", nullable=false)
     */
    private $timereser;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="iduser")
     * })
     */
    private $idUser;

    /**
     * @var \Restaurant
     *
     * @ORM\ManyToOne(targetEntity="Restaurant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_restau", referencedColumnName="id_restau")
     * })
     */
    private $idRestau;

    public function getIdRes(): ?int
    {
        return $this->idRes;
    }

    public function getDatereser(): ?\DateTimeInterface
    {
        return $this->datereser;
    }

    public function setDatereser(\DateTimeInterface $datereser): static
    {
        $this->datereser = $datereser;

        return $this;
    }

    public function getTimereser(): ?\DateTimeInterface
    {
        return $this->timereser;
    }

    public function setTimereser(\DateTimeInterface $timereser): static
    {
        $this->timereser = $timereser;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

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
