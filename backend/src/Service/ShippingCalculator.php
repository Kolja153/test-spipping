<?php

namespace App\Service;

use App\Service\Carrier\CarrierInterface;

class ShippingCalculator
{
    private $carrier;

    public function __construct(CarrierInterface $carrier)
    {
        $this->carrier = $carrier;
    }

    public function calculate(float $weight): float
    {
        return $this->carrier->calculateCost($weight);
    }
}
