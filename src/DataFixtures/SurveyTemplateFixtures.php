<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\QuestionOptionTemplate;
use App\Entity\QuestionTemplate;
use App\Entity\SurveyTemplate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class SurveyTemplateFixtures extends Fixture
{
    private const SURVEY = [
        'questions' => [
            [
                'title' => '1 + 1 =',
                'options' => [
                    [
                        'title' => '3',
                        'isRight' => false,
                    ],
                    [
                        'title' => '2',
                        'isRight' => true,
                    ],
                    [
                        'title' => '0',
                        'isRight' => false,
                    ],
                ],
            ],
            [
                'title' => '2 + 2 =',
                'options' => [
                    [
                        'title' => '4',
                        'isRight' => true,
                    ],
                    [
                        'title' => '3 + 1',
                        'isRight' => true,
                    ],
                    [
                        'title' => '10',
                        'isRight' => false,
                    ],
                ],
            ],
            [
                'title' => '3 + 3 =',
                'options' => [
                    [
                        'title' => '1 + 5',
                        'isRight' => true,
                    ],
                    [
                        'title' => '1',
                        'isRight' => false,
                    ],
                    [
                        'title' => '6',
                        'isRight' => true,
                    ],
                    [
                        'title' => '2 + 4',
                        'isRight' => true,
                    ],
                ],
            ],
            [
                'title' => '4 + 4 =',
                'options' => [
                    [
                        'title' => '8',
                        'isRight' => true,
                    ],
                    [
                        'title' => '4',
                        'isRight' => false,
                    ],
                    [
                        'title' => '0',
                        'isRight' => false,
                    ],
                    [
                        'title' => '0 + 8',
                        'isRight' => true,
                    ],
                ],
            ],
            [
                'title' => '5 + 5 =',
                'options' => [
                    [
                        'title' => '6',
                        'isRight' => false,
                    ],
                    [
                        'title' => '18',
                        'isRight' => false,
                    ],
                    [
                        'title' => '10',
                        'isRight' => true,
                    ],
                    [
                        'title' => '9',
                        'isRight' => false,
                    ],
                    [
                        'title' => '0',
                        'isRight' => false,
                    ],
                ],
            ],
            [
                'title' => '6 + 6 =',
                'options' => [
                    [
                        'title' => '3',
                        'isRight' => false,
                    ],
                    [
                        'title' => '9',
                        'isRight' => false,
                    ],
                    [
                        'title' => '0',
                        'isRight' => false,
                    ],
                    [
                        'title' => '12',
                        'isRight' => true,
                    ],
                    [
                        'title' => '5 + 7',
                        'isRight' => true,
                    ],
                ],
            ],
            [
                'title' => '7 + 7 =',
                'options' => [
                    [
                        'title' => '5',
                        'isRight' => false,
                    ],
                    [
                        'title' => '14',
                        'isRight' => true,
                    ],
                ],
            ],
            [
                'title' => '8 + 8 =',
                'options' => [
                    [
                        'title' => '16',
                        'isRight' => true,
                    ],
                    [
                        'title' => '12',
                        'isRight' => false,
                    ],
                    [
                        'title' => '9',
                        'isRight' => false,
                    ],
                    [
                        'title' => '5',
                        'isRight' => false,
                    ],
                ],
            ],
            [
                'title' => '9 + 9 =',
                'options' => [
                    [
                        'title' => '18',
                        'isRight' => true,
                    ],
                    [
                        'title' => '9',
                        'isRight' => false,
                    ],
                    [
                        'title' => '17 + 1',
                        'isRight' => true,
                    ],
                    [
                        'title' => '2 + 16',
                        'isRight' => true,
                    ],
                ],
            ],
            [
                'title' => '10 + 10 =',
                'options' => [
                    [
                        'title' => '0',
                        'isRight' => false,
                    ],
                    [
                        'title' => '2',
                        'isRight' => false,
                    ],
                    [
                        'title' => '8',
                        'isRight' => false,
                    ],
                    [
                        'title' => '20',
                        'isRight' => true,
                    ],
                ],
            ],
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $surveyTemplate = new SurveyTemplate();
        $manager->persist($surveyTemplate);

        foreach (self::SURVEY['questions'] as $question) {
            $questionTemplate = new QuestionTemplate();
            $surveyTemplate->addQuestion($questionTemplate);
            $questionTemplate->setTitle($question['title']);

            foreach ($question['options'] as $option) {
                $optionTemplate = new QuestionOptionTemplate();
                $questionTemplate->addOption($optionTemplate);
                $optionTemplate->setTitle($option['title']);
                $optionTemplate->setRight($option['isRight']);
            }
        }

        $manager->flush();
    }
}
