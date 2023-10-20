<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Survey;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Webmozart\Assert\Assert;

/**
 * @extends ServiceEntityRepository<Survey>
 *
 * @method Survey|null find($id, $lockMode = null, $lockVersion = null)
 * @method Survey|null findOneBy(array $criteria, array $orderBy = null)
 * @method Survey[]    findAll()
 * @method Survey[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class SurveyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Survey::class);
    }

    public function findUnfinished(): ?Survey
    {
        $survey = $this->createQueryBuilder('s')
            ->join('s.questions', 'q')
            ->where('q.isAnswered = false')
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult()
        ;
        Assert::nullOrIsInstanceOf($survey, Survey::class);

        return $survey;
    }
}
