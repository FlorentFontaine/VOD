<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController{

    public function __construct()
    {

    }
    
    /**
     *@Route("/serie", name="serie.index" )
     *@return Response
     */

    public function index(): Response
    {
        return $this->render("serie/serie.html.twig");
    }
}