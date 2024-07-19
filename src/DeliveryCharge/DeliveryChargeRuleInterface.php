<?php

declare(strict_types=1);

namespace App\DeliveryCharge;

interface DeliveryChargeRuleInterface
{
    public function appliesTo(float $amount): bool;
    
    public function getCharge(): float;
}