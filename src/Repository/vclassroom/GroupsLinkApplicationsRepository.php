<?php

namespace Vittascience\Repository\Vclassroom;

use Doctrine\ORM\EntityRepository;
use Vittascience\Entity\Vclassroom\Applications;
use Vittascience\Entity\Vclassroom\GroupsLinkApplications;

class GroupsLinkApplicationsRepository extends EntityRepository
{
    public function getAllApplicationsFromGroup(int $group_id) {

        $queryBuilder = $this->getEntityManager()
        ->createQueryBuilder();

        $queryBuilder->select("a")
            ->from(GroupsLinkApplications::class,'g')
            ->innerJoin(Applications::class,'a')
            ->where('g.group = :id AND g.application = a.id')
            ->setParameter('id', $group_id);
        $result = $queryBuilder->getQuery()->getResult();
        $Result_array=[];
        foreach ($result as $key => $value) {
            $Result_array[] = $value->jsonSerialize();
        }
        return $Result_array;
    }
}
