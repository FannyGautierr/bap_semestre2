<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\AgeGroup;
use App\Entity\Answer;
use App\Entity\Neighborhood;
use App\Entity\Question;
use App\Entity\QuestionsChoice;
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


        $questions = ["Dans quelle tranche d'âge vous situez-vous ?","Dans quel quartier habitez-vous ? ","Connaissez vous le dispositif Cité Éducative ?","Comment connaissez vous le dispositif  Cité Éducative ?","Avez-vous, vous ou votre enfant, participé à l'un de ces dispositifs ?","Pourriez vous nous décrire l'activité qui vous a le plus marqué ?","Trouvez-vous l'initiative des dispositifs de Cité Éducative intéressante  ?","Quel(s) domaine(s) aimeriez vous voir être développé lors des prochaines années ?","Avez-vous une idée précise d'activité pour ce domaine ?"];
        $types =["select","select","radio","select","checkbox","textarea","radio","textarea","checkbox","textarea"];

        foreach ($questions as $key => $question) {
            $question = new Question();
            $question->setTitle($questions[$key]);
            $question->setType($types[array_rand($types, 1)]);
            $question->setSurvey($survey);
            $manager->persist($question);
            $manager->flush();

            for ($i = 0; $i < 5; $i++) {
                $answer = new Answer();
                $answer->setQuestion($question);
                if($question->getType() == "radio"){
                    if(rand(0, 1)) {
                        $answer->setContent('true');
                    }else{
                        $answer->setContent('false');
                    }
                }else{
                    $answer->setContent("Réponse fvdsjkgbskgbdskvhnxiov $i");
                }
                $manager->persist($answer);
                $manager->flush();
            }
        }


    }
}
