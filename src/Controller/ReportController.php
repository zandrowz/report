<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {

        return $this->render('index.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {

        return $this->render('about.html.twig');
    }

    /**
     * @Route("/report", name="report")
     */
    public function report(): Response
    {

        return $this->render('report.html.twig');
    }
}
