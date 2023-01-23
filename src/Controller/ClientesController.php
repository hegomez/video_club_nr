<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ClientesType;
use App\Entity\Clientes;
use Symfony\Component\HttpFoundation\Request;


class ClientesController extends AbstractController
{
    /**
     * @Route("/clientes", name="app_clientes")
     */
    public function index(Request $reques): Response
    {
        $cliente= new Clientes();
        $form=$this->createForm(ClientesType::class,$cliente);
        $form->handleRequest($reques);
        if($form->isSubmitted() && $form->isValid()){
            //$cliente=$form->getData();
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($cliente);
            $entityManager->flush();
            $this->addFlash('success','Cliente Adicionado');
            return $this->redirectToRoute('app_clientes');
        }
        return $this->render('clientes/index.html.twig', [
            'controller_name' => 'ClientesController',
            'form' => $form->createView(),
        ]);
    }
}
