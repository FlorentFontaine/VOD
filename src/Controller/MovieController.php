<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\MovieSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\MovieSearchType;
use Knp\Component\Pager\PaginatorInterface;

class MovieController extends AbstractController{

    private $repository;
    private $em ;
    
    public function __construct(MovieRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    
    /**
     *@Route("/allmovies", name="allMovies.index" )
     *@return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new MovieSearch();
        $form = $this->createForm(MovieSearchType::class, $search);
        $form->handleRequest($request);

        $movies = $paginator->paginate($this->repository->findAllVisibleQuery($search), $request->query->getInt('page', 1), 2);
        return $this->render('movie/allMovies.html.twig', [ "movies" => $movies, 'form' => $form->createView() ]);
    }


    /**
     * @route ("/movie/{slug}-{id}", name="movie.show", requirements={"slug": "[a-z0-9\-]*"}))
     * @param Movie $movie
     * @return Response
     */
    public function show(Movie $movies, string $slug): Response
    {
        if ($movies->getSlug()!== $slug) {
            return $this->redirectToroute('movie.show', ['id' => $movies->getId(), 'slug' => $movies->getSlug()], 301 );
        }
        return $this->render('movie/movie.html.twig', ['movies' => $movies]);
    }
    


}