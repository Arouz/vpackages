<?php

namespace Vittascience\Repository\Vclassroom;

use Doctrine\ORM\EntityRepository;
use Vittascience\Entity\Vclassroom\ActivityLinkClassroom;


class ActivityLinkClassroomRepository extends EntityRepository
{
    public function getRetroAttributedActivitiesByClassroom($classroom){
        
        $retroAttributedActivities = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('alc')
            ->from(ActivityLinkClassroom::class,'alc')
            ->where("alc.classroom = :classroom AND alc.dateEnd >= :dateTrigger ")
            ->setParameters(array(
                'classroom' => $classroom,
                'dateTrigger' => new \DateTime('now')
            ))
            ->getQuery()
            ->getResult();

        return $retroAttributedActivities;
    }
}
