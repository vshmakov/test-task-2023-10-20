<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SurveyController extends AbstractController
{
    #[Route('/survey', name: 'app_survey')]
    public function index(): Response
    {
        return $this->render('survey/index.html.twig', [
            'controller_name' => 'SurveyController',
        ]);
    }
}
