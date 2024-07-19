<?php

declare(strict_types=1);

namespace App\Offer;

class BuyOneGetOneHalfPrice implements SpecialOffer
{
    private string $productCode;

    public function __construct(string $productCode)
    {
        $this->productCode = $productCode;
    }

    public function apply(array $items): float
    {
        $count = 0;
        $price = 0.0;
        foreach ($items as $item) {
            if ($item->getCode() === $this->productCode) {
                $count++;
                $price += $item->getPrice();
            }
        }

        if ($count > 1) {
            return $price - ($items[0]->getPrice() / 2);
        }
        return $price;
    }
}
