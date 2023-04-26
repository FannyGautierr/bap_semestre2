<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use App\Entity\QuestionOption;
use App\Entity\Survey;
use App\Repository\SurveyRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        public ChartBuilderInterface $chartBuilder,
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $chart = $this->makeChart();



        return $this->render('admin/index.html.twig', [
            'chart' => $chart,
        ]);

    }

    public function makeChart() {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        return $chart;
    }

    public function configureAssets(): Assets
    {
        $assets = parent::configureAssets();

        $assets->addWebpackEncoreEntry('app');

        return $assets;
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('enquêtes', 'fas fa-list', Survey::class);
        yield MenuItem::linkToCrud('questions', 'fas fa-list', Question::class);
        yield MenuItem::linkToCrud('questionsOptions', 'fas fa-list', QuestionOption::class);
        yield MenuItem::linkToLogout('Logout', 'fa-solid fa-arrow-right-from-bracket');
    }
}
