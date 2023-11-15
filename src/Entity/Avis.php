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
    private ?int $id = null;
    
    #[ORM\Column(length: 255)]
    private ?string $pubavis = null;

    #[ORM\Column(length: 255)]
    private ?string $titreavis = null;


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateavis = null;   
    

    
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'iduser', referencedColumnName: 'iduser')]
    private ?User $user=null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    #[ORM\JoinColumn(name: 'id_restau', referencedColumnName: 'id_restau')]
    private ?Restaurant $restaurant = null;

    
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

  

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getDateavis(): ?\DateTimeInterface
    {
        return $this->dateavis;
    }

    public function setDateavis(\DateTimeInterface $dateavis): static
    {
        $this->dateavis = $dateavis;

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