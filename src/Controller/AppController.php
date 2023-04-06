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
                    'content' => 'lorem ipsum',
                    'firstName' => 'Marie',
                    'age' => 41
                ],
                [
                    'content' => 'lorem ipsum',
                    'firstName' => 'Marie',
                    'age' => 41
                ],
                [
                    'content' => 'lorem ipsum',
                    'firstName' => 'Marie',
                    'age' => 41
                ],
                [
                    'content' => 'lorem ipsum',
                    'firstName' => 'Marie',
                    'age' => 41
                ],
                [
                    'content' => 'lorem ipsum',
                    'firstName' => 'Marie',
                    'age' => 41
                ],
                [
                    'content' => 'lorem ipsum',
                    'firstName' => 'Marie',
                    'age' => 41
                ],
                [
                    'content' => 'lorem ipsum',
                    'firstName' => 'Marie',
                    'age' => 41
                ],

            ]
        ]);
    }
}
