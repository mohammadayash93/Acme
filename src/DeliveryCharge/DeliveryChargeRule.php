<?php

namespace App\DeliveryCharge;

class DeliveryChargeRule implements DeliveryChargeRuleInterface
{
    private float $minAmount;
    private float $maxAmount;
    private float $charge;

    public function __construct(float $minAmount, float $maxAmount, float $charge)
    {
        $this->minAmount = $minAmount;
        $this->maxAmount = $maxAmount;
        $this->charge = $charge;
    }

    public function appliesTo(float $amount): bool
    {
        return $amount >= $this->minAmount && $amount < $this->maxAmount;
    }

    public function getCharge(): float
    {
        return $this->charge;
    }
}
