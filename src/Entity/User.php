<?php

namespace App\Entity;
th: 300)]
    private ?string $email = '';

    #[ORM\Column(length: 300)]  return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->role;
        // guarantee every user at least has ROLE_USER
        

        return array_unique($roles);
    }
    public function getRole(): array
{
    return $this->role;
}

        return $this;
    }

    public function getLastname(): ?string
    {
       

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }
    

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;

}
