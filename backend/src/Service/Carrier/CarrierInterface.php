<?php

namespace App\Service\Carrier;

interface CarrierInterface
{
    public function calculateCost(float $weight): float;
}
