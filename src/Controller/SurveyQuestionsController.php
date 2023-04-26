<?php

namespace App\Controller;

use App\Repository\SurveyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SurveyQuestionsController extends AbstractController
{
    #[Route('/survey/questions/{id}', name: 'app_survey_questions')]
    public function index($id, SurveyRepository $surveyRepository)
    {
        $survey = $surveyRepository
            ->find($id);

        $questions = $survey->getQuestions();

        return $this->render('survey_questions/index.html.twig', [
            'survey' => $survey,
            'questions' => $questions,
        ]);
    }
    //zz
}
