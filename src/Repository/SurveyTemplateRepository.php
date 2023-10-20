<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\SurveyTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SurveyTemplate>
 *
 * @method SurveyTemplate|null find($id, $lockMode = null, $lockVersion = null)
 * @method SurveyTemplate|null findOneBy(array $criteria, array $orderBy = null)
 * @method SurveyTemplate[]    findAll()
 * @method SurveyTemplate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class SurveyTemplateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SurveyTemplate::class);
    }
}
