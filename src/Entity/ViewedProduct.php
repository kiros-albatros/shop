<?php

namespace App\Entity;

use App\Repository\ViewedProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ViewedProductRepository::class)]
class ViewedProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $seller_id = null;

    #[ORM\Column]
    private ?int $product_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSellerId(): ?int
    {
        return $this->seller_id;
    }

    public function setSellerId(int $seller_id): self
    {
        $this->seller_id = $seller_id;

        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    public function setProductId(int $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }
}
