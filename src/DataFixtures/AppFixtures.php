<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\QuestionOption;
use App\Entity\Submitter;
use App\Entity\Survey;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $survey = new Survey();
        $survey->setName('CiteEducative');
        $survey->setDescription('Formulaire de feedback pour CiteEducative');
        $manager->persist($survey);
        $manager->flush();


        $questions = ["Quel âge avez-vous ?","Dans quel quartier habitez-vous ? ","Connaissez vous le dispositif Cité Éducative ?","Comment connaissez vous le dispositif  Cité Éducative ?","Avez-vous, vous ou votre enfant, participé à l'un de ces dispositifs ?","Pourriez vous nous décrire l'activité qui vous a le plus marqué ?","Trouvez-vous l'initiative des dispositifs de Cité Éducative intéressante  ?","Quel(s) domaine(s) aimeriez vous voir être développé lors des prochaines années ?","Avez-vous une idée précise d'activité pour ce domaine ?"];
        $types =["select","radio","checkbox","textarea"];

        foreach ($questions as $value) {
            $question = new Question();
            $question->setTitle($value);

            if($value == "Quel âge avez-vous ?"){
                $question->setType("textarea");
                $question->setFilter("age");
            }else{
                $question->setType($types[array_rand($types, 1)]);
            }
            $question->setSurvey($survey);
            $manager->persist($question);

            if ($question->getType() === "select" || $question->getType() === "checkbox") {

                for($i = 0; $i < 5; $i++){
                    $questionOption = new QuestionOption();
                    $questionOption->setQuestion($question);
                    $questionOption->setChoice("Option $i");
                    $manager->persist($questionOption);
                }
            }

            $manager->flush();
        }

        $questionsRepo = $manager->getRepository(Question::class);
        $questions = $questionsRepo->findAll();

        $questionsOptionsRepo = $manager->getRepository(QuestionOption::class);

        for ($i = 0; $i < 20; $i++) {
            $submitter = new Submitter();
            $submitter->setSurvey($survey);

            foreach ($questions as $question) {

                $questionId = $question->getId();
                $questionOptions = $questionsOptionsRepo->findBy(['question' => $questionId]);
                $choices = [];
                foreach ($questionOptions as $questionOption) {
                    $choices[] = $questionOption->getChoice();
                }


                $answer = new Answer();
                $answer->setQuestion($question);

                switch ($question->getType()) {
                    case "select":
                        $answer->setContent($choices[rand(0, count($choices) - 1)]);
                        break;
                    case "radio":
                        if (rand(0, 1)) {
                            $answer->setContent('true');
                        } else {
                            $answer->setContent('false');
                        }
                        break;
                    case "checkbox":
                        $options = [];
                        for ($j = 0; $j < rand(1, 4); $j++) {
                            $choice = $choices[rand(0, count($choices) - 1)];
                            while (in_array($choice, $options)) {
                                $choice = $choices[rand(0, count($choices) - 1)];
                            }
                            $options[] = $choice;
                        }
                        $answer->setContent(implode(',', $options));
                        break;
                    case "textarea":
                        if ($question->getFilter() === "age") {
                            $answer->setContent(rand(0, 100));
                        }else{
                            $answer->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor, nisl eget aliquam tincidunt, nisl nisl aliquam nisl, eget aliquam nisl nisl eget nisl. Donec auctor, nisl eget aliquam tincidunt, nisl nisl aliquam nisl, eget aliquam nisl nisl eget nisl. Donec auctor, nisl eget aliquam tincidunt, nisl nisl aliquam nisl, eget aliquam nisl nisl eget nisl. Donec auctor, nisl eget aliquam tincidunt, nisl nisl aliquam nisl, eget ');
                        }
                        break;
                }
                $answer->setSubmitter($submitter);
                $manager->persist($answer);
            }
            $manager->persist($submitter);
        }
        $manager->flush();
    }
}