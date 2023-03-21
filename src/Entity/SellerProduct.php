<?php

namespace App\Entity;

use App\Repository\SellerProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SellerProductRepository::class)]
class SellerProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'sellerProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Seller $seller = null;

    #[ORM\ManyToOne(inversedBy: 'sellerProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

//    /**
//     * @ORM\ManyToOne(targetEntity="Seller")
//     * @ORM\JoinColumn(nullable=false)
//     */
//    private $seller;
//
//    /**
//     * @ORM\ManyToOne(targetEntity="Product")
//     * @ORM\JoinColumn(nullable=false)
//     */
//    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

//    /**
//     * @return mixed
//     */
//    public function getSeller()
//    {
//        return $this->seller;
//    }
//
//    /**
//     * @param mixed $seller
//     */
//    public function setSeller($seller): void
//    {
//        $this->seller = $seller;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getProduct()
//    {
//        return $this->product;
//    }
//
//    /**
//     * @param mixed $product
//     */
//    public function setProduct($product): void
//    {
//        $this->product = $product;
//    }

public function getSeller(): ?Seller
{
    return $this->seller;
}

public function setSeller(?Seller $seller): self
{
    $this->seller = $seller;

    return $this;
}

public function getProduct(): ?Product
{
    return $this->product;
}

public function setProduct(?Product $product): self
{
    $this->product = $product;

    return $this;
}
}
