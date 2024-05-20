<?php

namespace App\Service;

use App\Service\Carrier\CarrierInterface;
use App\Service\Carrier\PackGroup;
use App\Service\Carrier\TransCompany;

class CarrierFactory
{
    const TRANS_COMPANY = 'trans_company';
    const PACK_GROUP = 'pack_group';

    const CARRIERS = [
        self::TRANS_COMPANY => TransCompany::class,
        self::PACK_GROUP => PackGroup::class,
    ];

    public static function createCarrier(string $slug): ?CarrierInterface
    {
        if (isset(self::CARRIERS[$slug])) {

            $class = self::CARRIERS[$slug];
            return new $class();
        }
    }

    public static function getCarriers(): array
    {
        return array_keys(self::CARRIERS);
    }
}
