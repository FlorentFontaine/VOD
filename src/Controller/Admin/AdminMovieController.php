<?php 

namespace App\Controller\Admin;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\MovieType;
use Knp\Component\Pager\PaginatorInterface;


class AdminMovieController extends AbstractController{

    private $title;
    private $temps;
    
    public function __construct(MovieRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

     /**
     * @Route("/admin", name="admin.movie.index")
     * @var Symfony\Component\HttpFoundation\Response;
    */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {        
        $movies = $paginator->paginate($this->repository->findAllVisibleQuery(), $request->query->getInt('page', 1), 4);
        return $this->render('admin/movie/index.html.twig', ['movies' => $movies] );
    }

    /**
     * @route ("/admin/movie/create", name="admin.movie.new")
     */
    public function new( Request $request ){
        $movies = new Movie();
        $form = $this->createForm(MovieType::class, $movies);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid() ) {
            $this->em->persist($movies);
            $this->em->flush();
            $this->addFlash('success', "Bien ajouter");
            return $this->redirectToRoute('admin.movie.index');
        }
        return $this->render('admin/movie/new.html.twig', 
        ['movies' => $movies,
        'form' => $form->createView()]);

    }

    /**
     * @Route ("/admin/movie/{id}", name="admin.movie.edit", methods="GET|POST")
     */
    public function edit(Movie $movies, Request $request){
        $form = $this->createForm(MovieType::class, $movies);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() ) {
            $this->em->flush();
            $this->addFlash('success', "Bien modifier");
            return $this->redirectToRoute('admin.movie.index');
        }
        return $this->render('admin/movie/edit.html.twig', 
        ['movies' => $movies,
        'form' => $form->createView()]
    
    );
}
    
    /**
     * @Route ("/admin/movie/{id}", name="admin.movie.delete", methods="DELETE")
     */
    public function delete(Movie $movies){
        $this->em->remove($movies);
        $this->em->flush();
        $this->addFlash('success', "Bien supprimer");
        return $this->redirectToRoute('admin.movie.index');
    }


}