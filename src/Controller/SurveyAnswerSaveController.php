<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\Submitter;
use App\Repository\QuestionRepository;
use App\Repository\SurveyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SurveyAnswerSaveController extends AbstractController
{
    #[Route('/survey/answer/save', name: 'app_survey_answer_save')]
    public function index(Request $request, EntityManagerInterface $manager, QuestionRepository $questionRepository, SurveyRepository $surveyRepository): Response
    {
        //dd($request->request->all());
        $requestData = $request->request->all();
        $keysArray = array_keys($requestData);

        $survey_id = $requestData["survey_ID"];
        $survey = $surveyRepository->find($survey_id);
        //dd($survey_id);

        $submitter = new Submitter();
        $submitter->setSurvey($survey);

        $manager->persist($submitter);
        $manager->flush();

        $index = 1;
        //dd($keysArray[0]);
        //dd($question);

        foreach($requestData as $data) {
            if($data != "Envoyer") {
                //dd(($data));
                $question = $questionRepository->find($index);
                //dd(gettype($question));
                $answer = new Answer();
                $answer->setQuestion($question);
                $answer->setContent($data);
                $answer->setSubmitter($submitter);

                $manager->persist($answer);

            }
            $index++;
        }
        $manager->flush();

        return $this->render('survey_answer_save/index.html.twig', [
            'controller_name' => 'SurveyAnswerSaveController',
        ]);
    }
}
