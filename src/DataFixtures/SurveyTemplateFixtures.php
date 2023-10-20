<?php

declare(strict_types=1);

namespace App\DataFixtures;

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


            ],
    ];

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
