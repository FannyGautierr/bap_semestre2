<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\AgeGroup;
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

        $age = ["- de 12 ans","12-18 ans","18-25 ans","+ de 25 ans"];
        $quartiers = ["Ponant / Chanteraines","Jean-Moulin / Sisley","Caravelle / Chaillon","Centre-ville","Rives de Seine / Gallieni","Haut et Fond de la Noue","Bongarde","Zone d’activités"];
        $activities = ["Aide Scolaire","Soutien à la recherche d'emploi","Sensibilisation/Prévention","Sportif","Apprentissage d'une langue","Artistique (théâtre, cinéma, musique)","Atelier découverte lecture/écriture","Activité familiale"];

        foreach ($age as $value) {
            $age = new AgeGroup();
            $age->setCategory($value);
            $manager->persist($age);
        }
        $manager->flush();

        foreach ($quartiers as $value) {
            $quartier = new Neighborhood();
            $quartier->setName($value);
            $manager->persist($quartier);
        }
        $manager->flush();

        foreach ($activities as $value) {
            $activity = new Activity();
            $activity->setName($value);
            $manager->persist($activity);
        }
        $manager->flush();



        $questions = ["Dans quelle tranche d'âge vous situez-vous ?","Dans quel quartier habitez-vous ? ","Connaissez vous le dispositif Cité Éducative ?","Comment connaissez vous le dispositif  Cité Éducative ?","Avez-vous, vous ou votre enfant, participé à l'un de ces dispositifs ?","Pourriez vous nous décrire l'activité qui vous a le plus marqué ?","Trouvez-vous l'initiative des dispositifs de Cité Éducative intéressante  ?","Quel(s) domaine(s) aimeriez vous voir être développé lors des prochaines années ?","Avez-vous une idée précise d'activité pour ce domaine ?"];
        $types =["select","select","radio","select","checkbox","textarea","radio","textarea","checkbox","textarea"];

      for ($i=0; $i < count($questions); $i++) {
            $question = new Question();
            $question->setQuestion($questions[$i]);
            $question->setType($types[$i]);
            $question->addSurvey($survey);
            $manager->persist($question);
            if($i == 0){

                foreach ($age as $value) {
                    $choice = new QuestionsChoice();
                    $choice->setAnswer($value);
                    $choice->setQuestion($question);
                    $manager->persist($choice);
                }
            }elseif ($i == 1) {

                foreach ($quartiers as $value) {
                    $choice = new QuestionsChoice();
                    $choice->setAnswer($value);
                    $choice->setQuestion($question);
                    $manager->persist($choice);
                }
            }elseif ($i == 2) {
                $choice = new QuestionsChoice();
                $choice->setAnswer("Oui");
                $choice->setQuestion($question);
                $manager->persist($choice);
                $choice = new QuestionsChoice();
                $choice->setAnswer("Non");
                $choice->setQuestion($question);
                $manager->persist($choice);

            }elseif ($i == 3) {
                $choice = new QuestionsChoice();
                $choice->setAnswer("Instagram");
                $choice->setQuestion($question);
                $manager->persist($choice);
                $choice = new QuestionsChoice();
                $choice->setAnswer("Facebook");
                $choice->setQuestion($question);
                $manager->persist($choice);
                $choice = new QuestionsChoice();
                $choice->setAnswer("La ville");
                $choice->setQuestion($question);
                $manager->persist($choice);
                $choice = new QuestionsChoice();
                $choice->setAnswer("Un.e ami.e");
                $choice->setQuestion($question);
                $manager->persist($choice);
                $choice = new QuestionsChoice();
                $choice->setAnswer("Un parent");
                $choice->setQuestion($question);
                $manager->persist($choice);
                $choice = new QuestionsChoice();
                $choice->setAnswer("Mon enfant");
                $choice->setQuestion($question);
                $manager->persist($choice);
                $choice = new QuestionsChoice();
                $choice->setAnswer("Autre ...");
                $choice->setQuestion($question);
                $manager->persist($choice);
            }elseif ($i == 4) {

                foreach ($activities as $value) {
                    $choice = new QuestionsChoice();
                    $choice->setAnswer($value);
                    $choice->setQuestion($question);
                    $manager->persist($choice);
                }
            }elseif ($i == 5) {
                dump("hey");
            }elseif ($i == 6) {
                $choice = new QuestionsChoice();
                $choice->setAnswer("Oui");
                $choice->setQuestion($question);
                $manager->persist($choice);
                $choice = new QuestionsChoice();
                $choice->setAnswer("Non");
                $choice->setQuestion($question);
                $manager->persist($choice);
            }elseif ($i == 7) {
                dump("hey");

            }elseif ($i == 8) {

                foreach ($activities as $value) {
                    $choice = new QuestionsChoice();
                    $choice->setAnswer($value);
                    $choice->setQuestion($question);
                    $manager->persist($choice);
                }
            }
        }

      $manager->flush();



    }
}
