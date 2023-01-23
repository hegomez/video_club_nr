<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FacturacionController extends AbstractController
{
    /**
     * @Route("/facturacion", name="app_facturacion")
     */
    public function index(): Response
    {
        return $this->render('facturacion/index.html.twig', [
            'controller_name' => 'FacturacionController',
        ]);
    }
}
