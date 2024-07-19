<?php

namespace App\Basket;

interface BasketInterface
{
    public function add(string $productCode): void;

    public function total(): float;    
}