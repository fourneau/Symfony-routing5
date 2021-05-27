<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;

use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;

/**
     * @Route("/programs", name="program_")
     */
class ProgramController extends AbstractController

{
 /**
     * @Route("/", name="index")
     * 
     */
    public function index(): Response

    {
        $programs = $this->getDoctrine()
             ->getRepository(Program::class)
             ->findAll();

        return $this->render('/program/index.html.twig', [

            'website' => 'Wild Séries',
            'programs' => $programs
         ]);
    }
/**
 * Getting a program by id
 *
 * @Route("/show/{id<^[0-9]+$>}", name="show")
 * @return Response
 */

public function show(int $id):Response

{

    $program = $this->getDoctrine()

        ->getRepository(Program::class)

        ->findOneBy(['id' => $id]);


    if (!$program) {

        throw $this->createNotFoundException(

            'No program with id : '.$id.' found in program\'s table.'

        );

    }

    return $this->render('program/show.html.twig', [

        'program' => $program,

    ]);

}
}