<?php

namespace App\Entity;

use App\Repository\SellerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SellerRepository::class)]
class Seller
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'seller', targetEntity: SellerProduct::class)]
    private Collection $sellerProducts;

    public function __construct()
    {
        $this->sellerProducts = new ArrayCollection();
    }

//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\SellerProduct", mappedBy="seller")
//     */
//    private $sellerPrices;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, SellerProduct>
     */
    public function getSellerProducts(): Collection
    {
        return $this->sellerProducts;
    }

    public function addSellerProduct(SellerProduct $sellerProduct): self
    {
        if (!$this->sellerProducts->contains($sellerProduct)) {
            $this->sellerProducts->add($sellerProduct);
            $sellerProduct->setSeller($this);
        }

        return $this;
    }

    public function removeSellerProduct(SellerProduct $sellerProduct): self
    {
        if ($this->sellerProducts->removeElement($sellerProduct)) {
            // set the owning side to null (unless already changed)
            if ($sellerProduct->getSeller() === $this) {
                $sellerProduct->setSeller(null);
            }
        }

        return $this;
    }
}
