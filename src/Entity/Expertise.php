<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expertise
 *
 * @ORM\Table(name="expertise")
 * @ORM\Entity
 */
class Expertise
{
    /**
     * @var int
     *
     * @ORM\Column(name="idIdee", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ididee;

    /**
     * @var int
     *
     * @ORM\Column(name="reponseAvis", type="integer", nullable=false)
     */
    private $reponseavis;

    /**
     * @var int
     *
     * @ORM\Column(name="dateIdee", type="integer", nullable=false)
     */
    private $dateidee;

    /**
     * @var int
     *
     * @ORM\Column(name="titreIdee", type="integer", nullable=false)
     */
    private $titreidee;

    /**
     * @var string
     *
     * @ORM\Column(name="pubIdee", type="string", length=2000, nullable=false)
     */
    private $pubidee;

    public function getIdidee(): ?int
    {
        return $this->ididee;
    }

    public function getReponseavis(): ?int
    {
        return $this->reponseavis;
    }

    public function setReponseavis(int $reponseavis): static
    {
        $this->reponseavis = $reponseavis;

        return $this;
    }

    public function getDateidee(): ?int
    {
        return $this->dateidee;
    }

    public function setDateidee(int $dateidee): static
    {
        $this->dateidee = $dateidee;

        return $this;
    }

    public function getTitreidee(): ?int
    {
        return $this->titreidee;
    }

    public function setTitreidee(int $titreidee): static
    {
        $this->titreidee = $titreidee;

        return $this;
    }

    public function getPubidee(): ?string
    {
        return $this->pubidee;
    }

    public function setPubidee(string $pubidee): static
    {
        $this->pubidee = $pubidee;

        return $this;
    }


}
