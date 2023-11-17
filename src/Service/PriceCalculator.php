<?php

namespace App\Service;

use App\Entity\Product;
use App\Entity\Promo;

// Calcule de la promotion sur le prix après promotion

class PriceCalculator
{
    public function calculateDiscountedPrice(Product $product)
    {
        $discount = $product->getPromo();
        $discountedPercentage = $discount ? $discount->getPourcentage() : 0;
        $price = $product->getPrice();

        $discountedPrice = $price - ($price * $discountedPercentage / 100);

        return $discountedPrice;
    }
}