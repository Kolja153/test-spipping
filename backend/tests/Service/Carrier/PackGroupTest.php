<?php

namespace App\Tests\Service\Carrier;

use App\Service\Carrier\PackGroup;
use PHPUnit\Framework\TestCase;

class PackGroupTest extends TestCase
{
    public function testCalculateCost()
    {
        $packGroup = new PackGroup();
        $this->assertEquals(5, $packGroup->calculateCost(5));
        $this->assertEquals(15, $packGroup->calculateCost(15));
    }
}