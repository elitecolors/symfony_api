<?php

namespace App\Entity;

use App\Repository\RandomUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RandomUserRepository::class)]
class RandomUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $gender;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $locationState;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $locationTimeOffset;

    #[ORM\Column(type: 'json', length: 255, nullable: true)]
    private $locationCordinates;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dobDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $registredDate;

    #[ORM\Column(type: 'integer', length: 255, nullable: true)]
    private $age;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLocationState(): ?string
    {
        return $this->locationState;
    }

    public function setLocationState(?string $locationState): self
    {
        $this->locationState = $locationState;

        return $this;
    }

    public function getLocationTimeOffset(): ?string
    {
        return $this->locationTimeOffset;
    }

    public function setLocationTimeOffset(?string $locationTimeOffset): self
    {
        $this->locationTimeOffset = $locationTimeOffset;

        return $this;
    }

    public function getLocationCordinates(): ?array
    {
        return $this->locationCordinates;
    }

    public function setLocationCordinates(?array $locationCordinates): self
    {
        $this->locationCordinates = $locationCordinates;

        return $this;
    }

    public function getDobDate(): ?\DateTimeInterface
    {
        return $this->dobDate;
    }

    public function setDobDate(?\DateTimeInterface $dobDate): self
    {
        $this->dobDate = $dobDate;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getRegistredDate(): ?\DateTimeInterface
    {
        return $this->registredDate;
    }

    public function setRegistredDate(?\DateTimeInterface $registredDate): self
    {
        $this->registredDate = $registredDate;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }
}
