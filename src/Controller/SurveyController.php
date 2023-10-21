<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Question;
use App\Entity\QuestionOption;
use App\Entity\Survey;
use App\Entity\SurveyTemplate;
use App\Form\QuestionType;
use App\Repository\SurveyRepository;
use App\Repository\SurveyTemplateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Webmozart\Assert\Assert;

#[Route('/survey', name: 'survey_')]
final class SurveyController extends AbstractController
{
    public function __construct(
        private SurveyRepository $surveyRepository,
        private SurveyTemplateRepository $surveyTemplateRepository,
        private EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/answer', name: 'answer')]
    public function answer(Request $request): Response
    {
        $survey = $this->getActualSurvey();
        $question = $survey->getFirstUnansweredQuestion();
        Assert::notNull($question);
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question->setAnswered(true);
            $this->entityManager->flush();

            if (null === $survey->getFirstUnansweredQuestion()) {
                return $this->redirectToRoute('survey_result', [
                    'id' => $survey->getId(),
                ]);
            }

            return $this->redirectToRoute('survey_answer');
        }

        return $this->render('survey/answer.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/result', name: 'result')]
    public function result(Survey $survey): Response
    {
        return $this->render('survey/result.html.twig', [
            'survey' => $survey,
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
