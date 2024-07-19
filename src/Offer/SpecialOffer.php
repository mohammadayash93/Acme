<?php

declare(strict_types=1);

namespace App\Offer;

interface SpecialOffer
{
    public function apply(array $items): float;
}
