<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\QuestionOptionTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuestionOptionTemplate>
 *
 * @method QuestionOptionTemplate|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionOptionTemplate|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionOptionTemplate[]    findAll()
 * @method QuestionOptionTemplate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class QuestionOptionTemplateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionOptionTemplate::class);
    }
}
