<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use App\Entity\QuestionOption;
use App\Entity\Survey;
use App\Entity\User;
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

        return $this->render('admin/index.html.twig', []);

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
        yield MenuItem::linkToCrud('Enquêtes', 'fa-solid fa-square-poll-horizontal', Survey::class);
        yield MenuItem::linkToCrud('Questions', 'fa-solid fa-clipboard-question', Question::class)->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToCrud('Questions Options', 'fa-solid fa-gear', QuestionOption::class)->setPermission('ROLE_SUPER_ADMIN');;
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-users', User::class)->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToLogout('Logout', 'fa-solid fa-arrow-right-from-bracket');
    }
}
