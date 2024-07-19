<?php

namespace Tests;

use App\Basket\Basket;
use App\DeliveryCharge\DeliveryChargeRule;
use App\DeliveryCharge\DeliveryChargeRules;
use App\DeliveryCharge\DeliveryChargeRulesInterface;
use App\Offer\BuyOneGetOneHalfPrice;
use App\Product\Product;
use App\Product\ProductCatalogueInterface;
use App\Product\ProductCatalogue;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    private ProductCatalogueInterface $catalogue;
    private DeliveryChargeRulesInterface $deliveryRules;

    protected function setUp(): void
    {
        $this->catalogue = new ProductCatalogue();
        $this->catalogue->addProduct(new Product('R01', 'Red Widget', 32.95));
        $this->catalogue->addProduct(new Product('G01', 'Green Widget', 24.95));
        $this->catalogue->addProduct(new Product('B01', 'Blue Widget', 7.95));

        $this->deliveryRules = new DeliveryChargeRules();
        $this->deliveryRules->addRule(new DeliveryChargeRule(0, 50, 4.95));
        $this->deliveryRules->addRule(new DeliveryChargeRule(50, 90, 2.95));
        $this->deliveryRules->addRule(new DeliveryChargeRule(90, PHP_FLOAT_MAX, 0));
    }

    public function testBasketTotal(): void
    {
        $basket = new Basket($this->catalogue, $this->deliveryRules, [new BuyOneGetOneHalfPrice('R01')]);

        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(37.85, $basket->total());

        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(54.37, $basket->total());

        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(60.85, $basket->total());

        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(98.27, $basket->total());
    }
}
