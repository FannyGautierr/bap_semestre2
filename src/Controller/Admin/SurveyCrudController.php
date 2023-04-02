<?php

namespace App\Controller\Admin;

use App\Entity\Survey;
use App\Repository\SurveyRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class SurveyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Survey::class;
    }


    #[Route('/admin/survey/{id}/stats', name: 'survey_stats')]
    public function statistics($id, SurveyRepository $surveyRepository, ChartBuilderInterface $chartBuilder): Response
    {
        $survey = $surveyRepository->find($id);
        if($survey === null) {
            throw $this->createNotFoundException('Enquête inconnue');
        }

        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);

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

        return $this->render('admin/stats.html.twig', [
            'survey' => $survey,
            'chart' => $chart,
        ]);
    }

    public function configureActions(Actions $actions): Actions
    {
        $stats = Action::new('stats', 'Statistiques', 'fa fa-chart-bar')
            ->addCssClass('btn btn-primary')
            ->linkToRoute('survey_stats', function (Survey $survey) {
                return ['id' => $survey->getId()];
            });
        return $actions
            ->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN')
            ->setPermission(Action::NEW, 'ROLE_SUPER_ADMIN')
            ->setPermission(Action::EDIT, 'ROLE_SUPER_ADMIN')
            ->add(Crud::PAGE_INDEX, $stats);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnIndex(),
            TextField::new('name'),
            TextEditorField::new('description'),
        ];
    }

}
