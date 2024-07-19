<?php

namespace App\DeliveryCharge;

class DeliveryChargeRules implements DeliveryChargeRulesInterface
{
    private array $rules = [];

    public function addRule(DeliveryChargeRule $rule): void
    {
        $this->rules[] = $rule;
    }

    public function getCharge(float $amount): float
    {
        foreach ($this->rules as $rule) {
            if ($rule->appliesTo($amount)) {
                return $rule->getCharge();
            }
        }
        return 0.0; // Free delivery
    }
}
