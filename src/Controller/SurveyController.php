<?php
namespace App\Controller;

use App\Repository\SurveyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SurveyController extends AbstractController
{
    #[Route('/survey', name: 'app_survey')]
    public function index(SurveyRepository $surveyRepository)
    {
        $surveys = $surveyRepository->findAll();

        return $this->render('survey/index.html.twig', [
            'surveys' => $surveys,
        ]);
    }

    public function details($id, SurveyRepository $surveyRepository)
    {
        $survey = $surveyRepository
            ->find($id);

        $questions = $survey->getQuestions();

        return $this->render('survey/details.html.twig', [
            'survey' => $survey,
            'questions' => $questions,
        ]);
        //ZZ
    }
}
