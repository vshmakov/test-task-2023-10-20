<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Question;
use App\Entity\QuestionOption;
use App\Entity\Survey;
use App\Entity\SurveyTemplate;
use App\Repository\SurveyRepository;
use App\Repository\SurveyTemplateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SurveyController extends AbstractController
{
    public function __construct(
        private SurveyRepository $surveyRepository,
        private SurveyTemplateRepository $surveyTemplateRepository,
        private EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/survey', name: 'app_survey')]
    public function index(): Response
    {
        $question = $this->getActualSurvey()
            ->getFirstUnansweredQuestion()
        ;

        return $this->render('survey/index.html.twig', [
            'controller_name' => 'SurveyController',
        ]);
    }

    private function getActualSurvey(): Survey
    {
        $survey = $this->surveyRepository->findUnfinished();

        if (null !== $survey) {
            return $survey;
        }

        $survey = $this->createSurveyByTemplate(
            $this->surveyTemplateRepository->requireTemplate()
        );
        $this->entityManager->persist($survey);
        $this->entityManager->flush();

        return $survey;
    }

    private function createSurveyByTemplate(SurveyTemplate $template): Survey
    {
        $survey = new Survey();
        $survey->setTemplate($template);

        foreach ($template->getQuestions() as $questionTemplate) {
            $question = new Question();
            $survey->addQuestion($question);
            $question->setTitle($questionTemplate->requireTitle());

            foreach ($questionTemplate->getOptions() as $optionTemplate) {
                $option = new QuestionOption();
                $question->addOption($option);
                $option->setTitle($optionTemplate->requireTitle());
                $option->setRight($optionTemplate->isRight());
            }
        }

        return $survey;
    }
}
