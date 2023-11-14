<?php



namespace App\Entity;
use App\Repository\AvisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(length:35)]
    private $pubavis;

    #[ORM\Column(length:35)]
    private $titreavis;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateavis = null;
    

    #[ORM\ManyToOne(inversedBy: 'Avis')]
   private ?User $user=null;
    
   #[ORM\ManyToOne(inversedBy: 'Avis')]
   private ?Restaurant $restaurant=null;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): static
    {
        $this->restaurant = $restaurant;

        return $this;
    }


}