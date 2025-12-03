<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class NetworkDeviceController extends AbstractController
{
    #[Route('/network/device', name: 'app_network_device')]
    public function index(): Response
    {
        return $this->render('network_device/index.html.twig', [
            'controller_name' => 'NetworkDeviceController',
        ]);
    }
    #[Route('/network/device/add', name: 'app_network_device_add', methods: ['GET', 'POST'])]
    public function add(): Response
    {

        return $this->render('network_device/add.html.twig', []);
    }
    public function show(string $id): Response
    {

    }

    public function update(string $id): Response
    {

    }

    public function delete(string $id): Response
    {

    }
}
