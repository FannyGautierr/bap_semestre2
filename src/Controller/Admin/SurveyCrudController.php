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

        $charts = [];



        $questions = $survey->getQuestions();
        foreach ($questions as $question) {
            switch ($question->getType()){
                case 'radio':
                    $chart = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
                    $answers = $question->getAnswers();
                    $yes = 0;
                    $no = 0;
                    foreach ($answers as $answer) {
                        if($answer->getContent() === 'true') {
                            $yes++;
                        } else {
                            $no++;
                        }
                    }

                    $chart->setData([
                        'type' => 'doughnut',
                        'labels' => ['Oui', 'Non'],
                        'datasets' => [
                            [
                                'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)'],
                                'borderColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)'],
                                'data' => [$yes, $no],
                            ],
                        ],
                    ]);

                    $charts[] = ['question' => $question->getId(), 'chart' => $chart];
                    break;

                case 'checkbox':
                    $chart = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
                    $answers = $question->getAnswers();
                    //get questions options for labels
                    $options = $question->getQuestionOptions();
                    $labels = [];
                    $data = [];
                    foreach ($options as $option) {
                        $choice = $option->getChoice();
                        $labels[] = $choice;
                        //count answers for each option
                        $count = 0;
                        foreach ($answers as $answer) {

                            $answerArray = explode(',', $answer->getContent());
                            if(in_array($choice, $answerArray)) {
                                $count++;
                            }
                        }
                        $data[] = $count;
                    }

                    $chart->setData([
                        'type' => 'doughnut',
                        'labels' => $labels,
                        'datasets' => [
                            [
                                'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 'rgb(255, 159, 64)'],
                                'borderColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 'rgb(255, 159, 64)'],
                                'data' => $data,
                            ],
                        ],
                    ]);

                    $charts[] = ['question' => $question->getId(), 'chart' => $chart];
                    break;

                case 'select':
                    $chart = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
                    $answers = $question->getAnswers();
                    $options = $question->getQuestionOptions();
                    $labels = [];
                    $data = [];
                    foreach ($options as $option) {
                        $choice = $option->getChoice();
                        $labels[] = $choice;
                        $count = 0;
                        foreach ($answers as $answer) {
                            if($answer->getContent() === $choice) {
                                $count++;
                            }
                        }
                        $data[] = $count;
                    }

                    $chart->setData([
                        'type' => 'doughnut',
                        'labels' => $labels,
                        'datasets' => [
                            [
                                'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 'rgb(255, 159, 64)'],
                                'borderColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 'rgb(255, 159, 64)'],
                                'data' => $data,
                            ],
                        ],
                    ]);

                    $charts[] = ['question' => $question->getId(), 'chart' => $chart];
                    break;
            }
        }




        return $this->render('admin/stats.html.twig', [
            'survey' => $survey,
            'charts' => $charts,
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
