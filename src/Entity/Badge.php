<?php

namespace App\Entity;

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


}
