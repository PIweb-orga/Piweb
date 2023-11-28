<?php

namespace App\Entity;
use App\Repository\UserRepository;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $iduser = null;

    #[ORM\Column(length: 30)]
    private ?string $username = '';

    #[ORM\Column(length: 300)]
    private ?string $email = '';

    #[ORM\Column(length: 300)]
    private ?string $password = '';

    #[ORM\Column(length: 30)]
    private ?string $firstname = '';

    #[ORM\Column(length: 30)]
    private ?string $lastname = '';

    #[ORM\Column(nullable: true, length: 20)]
    private ?string $tel = '';

    #[ORM\Column(nullable: true, length: 300)]
    private ?string $address = '';

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $role = '';

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }
}
