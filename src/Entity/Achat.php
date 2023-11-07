<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Achat
 *
 * @ORM\Table(name="achat", indexes={@ORM\Index(name="fk_plt", columns={"idplat"}), @ORM\Index(name="fk_usr", columns={"iduser"})})
 * @ORM\Entity
 */
class Achat
{
    /**
     * @var int
     *
     * @ORM\Column(name="idachat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idachat;

    /**
     * @var float
     *
     * @ORM\Column(name="montanttotal", type="float", precision=10, scale=0, nullable=false)
     */
    private $montanttotal;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=0, nullable=false)
     */
    private $type;

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
     * @var \Plat
     *
     * @ORM\ManyToOne(targetEntity="Plat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idplat", referencedColumnName="idplat")
     * })
     */
    private $idplat;

    public function getIdachat(): ?int
    {
        return $this->idachat;
    }

    public function getMontanttotal(): ?float
    {
        return $this->montanttotal;
    }

    public function setMontanttotal(float $montanttotal): static
    {
        $this->montanttotal = $montanttotal;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

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

    public function getIdplat(): ?Plat
    {
        return $this->idplat;
    }

    public function setIdplat(?Plat $idplat): static
    {
        $this->idplat = $idplat;

        return $this;
    }


}
