<?php

namespace App\Basket;
use App\DeliveryCharge\DeliveryChargeRulesInterface;
use App\Product\ProductCatalogueInterface;

class Basket implements BasketInterface
{
    private ProductCatalogueInterface $catalogue;
    private DeliveryChargeRulesInterface $deliveryRules;
    private array $offers;
    private array $items = [];

    public function __construct(
        ProductCatalogueInterface $catalogue,
        DeliveryChargeRulesInterface $deliveryRules,
        array $offers = []
    ) {
        $this->catalogue = $catalogue;
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
    }

    public function add(string $productCode): void
    {
        $product = $this->catalogue->getProduct($productCode);
        if ($product) {
            $this->items[] = $product;
        }
    }

    public function total(): float
    {
        $total = 0.0;

        // Apply offers
        foreach ($this->offers as $offer) {
            $total += $offer->apply($this->items);
        }

        // Calculate the total without offers
        foreach ($this->items as $item) {
            $total += $item->getPrice();
        }

        // Apply delivery charges
        $total += $this->deliveryRules->getCharge($total);

        return $total;
    }
}
