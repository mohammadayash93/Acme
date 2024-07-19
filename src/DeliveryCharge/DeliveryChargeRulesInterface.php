<?php

declare(strict_types=1);

namespace App\DeliveryCharge;

interface DeliveryChargeRulesInterface
{
    public function addRule(DeliveryChargeRule $rule): void;
    public function getCharge(float $amount): float;
}