<?php

namespace App\Product;

interface ProductInterface
{
    public function getCode(): string;

    public function getName(): string;

    public function getPrice(): float;
}
