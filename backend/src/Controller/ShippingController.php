<?php

namespace App\Controller;

use App\Provider\CarrierProvider;
use App\Service\CarrierFactory;
use App\Service\ShippingCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShippingController extends AbstractController
{
    #[Route('/api/calculate', name: 'calculate_shipping', methods: ['POST'])]
    public function calculate(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $weight = $data['weight'];
        $carrierSlug = $data['carrier'];

        $carrier = CarrierFactory::createCarrier($carrierSlug);

        $calculator = new ShippingCalculator($carrier);
        $cost = $calculator->calculate($weight);

        return $this->json(['cost' => $cost]);
    }

    #[Route('/api/carriers_slag', name: 'carriers_slag', methods: ['GET'])]
    public function carrierSlags(Request $request): Response
    {
        $carriers = array_keys(CarrierFactory::CARRIERS);

        return $this->json(['carriers' => $carriers]);
    }
}
