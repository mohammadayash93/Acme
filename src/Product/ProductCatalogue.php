<?php


namespace App\Product;

class ProductCatalogue implements ProductCatalogueInterface
{
    private array $products = [];

    public function addProduct(Product $product): void
    {
        $this->products[$product->getCode()] = $product;
    }

    public function getProduct(string $code): ?Product
    {
        return $this->products[$code] ?? null;
    }
}
