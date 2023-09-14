<?php

namespace Vittascience\Repository\Vlearn;

use Doctrine\ORM\EntityRepository;
use Vittascience\Entity\Vlearn\CourseLinkActivity;

class RepositoryCourseLinkActivity extends EntityRepository
{
    public function getActivitiesOrdered($idTuto)
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder();
        $queryBuilder->select('t')
            ->from(CourseLinkActivity::class, 't')
            ->where('t.course= :idTuto')
            ->setParameter('idTuto',$idTuto)
            ->orderBy(' t.indexOrder', 'ASC');
        $query = $queryBuilder->getQuery();
        // echo ($queryBuilder->getDql());
        return $query->getResult();
    }
}
