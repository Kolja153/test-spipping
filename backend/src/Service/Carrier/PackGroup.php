<?php

namespace App\Service\Carrier;

class PackGroup implements CarrierInterface
{
    public function calculateCost(float $weight): float
    {
        return $weight * 1;
    }
}