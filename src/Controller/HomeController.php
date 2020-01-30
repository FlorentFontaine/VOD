<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController{

    /**
     * @route ("/", name="home.index")
     * @return Response
     */
    public function index(MovieRepository $repository): Response
    {   
        $movies = $repository->findLatest();
        dump($movies);
        return $this->render('pages/home.html.twig', ["movies" => $movies]  );
    }
}