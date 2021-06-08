<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Entity\Program;
use App\Form\CategoryType;
use App\Form\ProgrType;


/**
 
     * @Route("/categories", name="category_")
     
     */
    class CategoryController extends AbstractController
    {
        /**

     * The controller for the category add form

     *

     * @Route("/new", name="new")

     */

    public function new(Request $request) : Response

    {

        // Create a new Category Object

        $category = new Category();

        // Create the associated Form

        $form = $this->createForm(CategoryType::class, $category);

        // Get data from HTTP request

        $form->handleRequest($request);

        // Was the form submitted ?

        if ($form->isSubmitted() && $form->isValid()) {

            // Deal with the submitted data

            // For example : persiste & flush the entity

            // And redirect to a route that display the result
            $entityManager = $this->getDoctrine()->getManager();

        // Persist Category Object

        $entityManager->persist($category);

        // Flush the persisted object

        $entityManager->flush();

        // Finally redirect to categories list

        return $this->redirectToRoute('category_index');
        }

        // Render the form

        return $this->render('category/new.html.twig', ["form" => $form->createView()]);
    }
        /**
         * @Route("/", name="index")
         */
        public function index(): Response
        {
            $categories = $this->getDoctrine()
    
                 ->getRepository(Category::class)
    
                 ->findAll();
    
            return $this->render('category/index.html.twig', [
                'categories' => $categories,
            ]);
        }
    
    
          /**
         * @Route("/{categoryName}", name="show")
         */
        public function show(string $categoryName): Response
        {
            $category = $this->getDoctrine()
    
            ->getRepository(Category::class)
    
            ->findOneBy(['name' => $categoryName]);
    
            $programs = $this->getDoctrine()
    
            ->getRepository(Program::class)
    
            ->findBy(['category' => $category], ['id' => 'DESC'],3);
    
    
        if (!$category) {
    
            throw $this->createNotFoundException(
    
                'No category with name : '.$categoryName.' found in category\'s table.'
    
            );
    
        }
    
        return $this->render('category/show.html.twig', [
    
            'category' => $category,
            'programs' => $programs
    
        ]);
    
        }
        
    }