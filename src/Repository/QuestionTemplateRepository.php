<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\QuestionTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuestionTemplate>
 *
 * @method QuestionTemplate|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionTemplate|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionTemplate[]    findAll()
 * @method QuestionTemplate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class QuestionTemplateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionTemplate::class);
    }
}
