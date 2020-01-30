<?php

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class MovieController extends AbstractController{

    private $repository;
    private $em ;
    
    public function __construct(MovieRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    
    /**
     *@Route("/movie", name="movie.index" )
     *@return Response
     */
    public function index(): Response
    {
       $movie = $this->repository->findall();
        // $movie = new Movie;
        // $movie->setTitle("Kamelott")
        //         ->setDescription("recherche du Graal livre I")
        //         ->setTemps("3 heures")
        //         ->setMusique("Tududu")
        //         ->setRealisateur("Alexandre Astier")
        //         ->setActeur("Famille Astier")
        //         ->setVu(true)
        //         ->setGenre(1);
        //         $em = $this->getDoctrine()->getManager();
        //         $em->persist($movie);
        //         $em->flush();

        return $this->render('movie/movie.html.twig',
                     [ "current_menu" => "movie" ]);
    }


    /**
     * @route ("/movie/{slug}-{id}", name="movie.show", requirements={"slug": "[a-z0-9\-]*"}))
     * @param Movie $movie
     * @return Response
     */
    public function show(Movie $movie, string $slug): Response
    {
        if ($movie->getSlug()!== $slug) {
            return $this->redirectToroute('movie.show', ['id' => $movie->getId(), 'slug' => $movie->getSlug()], 301 );
        }
        return $this->render('movie/movie.html.twig', ['movie' => $movie]);
    }
    


}