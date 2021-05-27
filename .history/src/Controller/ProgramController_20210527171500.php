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
     * @return Response A response instance
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

public function show(int $id): Response
    {
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['id' => $id]);
        
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in program\'s table.'
            );
        }

        $seasons = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findBy(['programs' => $program->getId()]);

        // return $this->redirectToRoute('program_show', ['id' => $id]);
        return $this->render('program/show.html.twig', ['program' => $program, 'seasons' => $seasons,]);
    }

    /**
     * Getting a season by id
     * 
     * @Route("/{programId}/seasons/{seasonId}", name="season_show")
     * @return Response
     */
    public function showSeason(int $programId, int $seasonId): Response
    {
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['id' => $programId]);
        
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$programId.' found in program\'s table.'
            );
        }

        $season = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findOneBy(['id' => $seasonId]);

        $episodes = $this->getDoctrine()
            ->getRepository(Episode::class)
            ->findBy(['season' => $season->getId()]);

        // return $this->redirectToRoute('program_show', ['id' => $id]);
        return $this->render('program/season_show.html.twig', ['program' => $program, 'season' => $season, 'episodes' => $episodes]);
    }
}