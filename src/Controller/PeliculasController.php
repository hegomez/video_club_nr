<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PeliculasType;
use App\Entity\Peliculas;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class PeliculasController extends AbstractController
{
    /**
     * @Route("/peliculas", name="app_peliculas")
     */
    public function index(Request $reques): Response
    {
        $pelicula = new Peliculas();
        $form=$this->createForm(PeliculasType::class,$pelicula);
        $form->handleRequest($reques);
        if($form->isSubmitted() && $form->isValid()){
            $imagen=$form['imagen']->getData();
            if($imagen){
                $originalFilename=pathinfo($imagen->getClientOriginalName(),PATHINFO_FILENAME);
                $safeFilename=transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',$originalFilename);
                $newFilename=$safeFilename.'-'.uniqid().'.'.$imagen->guessExtension();
                try{
                    $imagen->move(
                        $this->getParameter('imagenes_directorio'),
                        $newFilename
                    );
                }catch(FileException $e){
                    throw new \Exception('Error al subir la imagen');
                }
                $pelicula->setImagen($newFilename);
            }
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($pelicula);
            $entityManager->flush();
            $this->addFlash('success','Pelicula Adicionada');
            return $this->redirectToRoute('app_peliculas');
        }
        return $this->render('peliculas/index.html.twig', [
            'controller_name' => 'PeliculasController',
            'form' => $form->createView(),
        ]);
    }
}
