<?php

namespace App\Tests\Service\Carrier;

use App\Service\Carrier\TransCompany;
use PHPUnit\Framework\TestCase;

class TransCompanyTest extends TestCase
{
    public function testCalculateCost()
    {
        $transCompany = new TransCompany();
        $this->assertEquals(20, $transCompany->calculateCost(5));
        $this->assertEquals(100, $transCompany->calculateCost(15));
    }
}