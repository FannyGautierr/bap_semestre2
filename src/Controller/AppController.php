<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class AppController extends AbstractController
{
    #[Route('/', name: 'app_app')]
    public function index(): Response
    {


        return $this->render('app/index.html.twig', [
            'reviews' => [
                [
                    'content' => 'Super utile pour mes cours en ligne!',
                    'firstName' => 'Sarah',
                    'age' => 25
                ],
                [
                    'content' => 'Je suis accro à cette plateforme éducative',
                    'firstName' => 'Nicolas',
                    'age' => 32
                ],
                [
                    'content' => 'J\'adore apprendre de nouvelles choses ici',
                    'firstName' => 'Emma',
                    'age' => 19
                ],
                [
                    'content' => 'Le contenu est vraiment intéressant et bien structuré',
                    'firstName' => 'Marc',
                    'age' => 45
                ],
                [
                    'content' => 'Je recommande vivement pour les étudiants en herbe',
                    'firstName' => 'Julie',
                    'age' => 22
                ],
                [
                    'content' => 'C\'est facile à utiliser et très enrichissant',
                    'firstName' => 'Thomas',
                    'age' => 38
                ],
                [
                    'content' => 'Super utile pour mes cours en ligne !',
                    'firstName' => 'Laura',
                    'age' => 27
                ],

            ]
        ]);
    }

    #[Route('/event', name: 'app_event')]
    public function event(): Response
    {
        return $this->render('app/event.html.twig');
    }

    #[Route('/actualite', name: 'app_actu')]
    public function actualite(): Response
    {
        return $this->render('app/actu.html.twig');
    }

    #[Route('/event2', name: 'app_event_villeneuve')]
    public function event2(): Response
    {
        return $this->render('app/eventVilleneuve.html.twig');
    }

    #[Route('/accueil', name: 'app_acceuil_villeneuve')]
    public function accueil(): Response
    {
        return $this->render('app/acceuilVilleneuve.html.twig');
    }
}
