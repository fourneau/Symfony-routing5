<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;

use App\Form\PType;

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

public function show(Program $program): Response
    {
        $seasons = $program->getSeasons();

        return $this->render('program/show.html.twig', ['program' => $program, 'seasons' => $seasons]);
    }

    /**
     * Getting a season by id
     * 
     * @Route("/{programId}/seasons/{seasonId}", name="season_show")
     * @return Response
     */
    public function showSeason(Program $programId, Season $seasonId): Response
    {

        $episodes = $seasonId->getEpisodes();

        return $this->render('program/season_show.html.twig', ['program' => $programId, 'season' => $seasonId, 'episodes' => $episodes]);
    }

    /**
     * Getting an episode by id
     * 
     * @Route("/{programId}/seasons/{seasonId}/episodes/{episodeId}", name="episode_show")
     * @return Response
     */
    public function showEpisode(Program $programId, Season $seasonId, Episode $episodeId): Response
    {

        return $this->render('program/episode_show.html.twig', ['program' => $programId, 'season' => $seasonId, 'episode' => $episodeId]);
    }
}