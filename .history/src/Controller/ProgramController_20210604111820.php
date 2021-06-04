<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;

/**
     * @Route("/programs/", name="program_index")
     */

class ProgramController extends AbstractController

{
 /**
     * @Route("/", name="index")
     */
    public function index(): Response

    {
        return $this->render('/program/index.html.twig', [

            'website' => 'Wild Séries',
     
         ]);
    }
/**
     * @Route("/{id}",requirements={"id"="\d+"}, methods={"GET"}, name="show")
     */
    public function show(int $id): Response

    {
        return $this->render('/program/show.html.twig', [

            'id' => $id,
     
         ]);
    }
}