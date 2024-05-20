<?php

namespace App\Service\Carrier;

class TransCompany implements CarrierInterface
{
    public function calculateCost(float $weight): float
    {
        return $weight <= 10 ? 20 : 100;
    }
}
