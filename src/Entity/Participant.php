<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Participant
 *
 * @ORM\Table(name="participant", indexes={@ORM\Index(name="fk_event", columns={"idevent"}), @ORM\Index(name="fk_user", columns={"iduser"})})
 * @ORM\Entity
 */
class Participant
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datepar", type="date", nullable=false)
     */
    private $datepar;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var int
     *
     * @ORM\Column(name="idParticipant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparticipant;

    /**
     * @var \Evennement
     *
     * @ORM\ManyToOne(targetEntity="Evennement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idevent", referencedColumnName="idevent")
     * })
     */
    private $idevent;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iduser", referencedColumnName="iduser")
     * })
     */
    private $iduser;

    public function getDatepar(): ?\DateTimeInterface
    {
        return $this->datepar;
    }

    public function setDatepar(\DateTimeInterface $datepar): static
    {
        $this->datepar = $datepar;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getIdparticipant(): ?int
    {
        return $this->idparticipant;
    }

    public function getIdevent(): ?Evennement
    {
        return $this->idevent;
    }

    public function setIdevent(?Evennement $idevent): static
    {
        $this->idevent = $idevent;

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


}
