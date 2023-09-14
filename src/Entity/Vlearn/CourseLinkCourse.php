<?php

namespace Vittascience\Entity\Vlearn;

use Doctrine\ORM\Mapping as ORM;
use Vittascience\Exceptions\Vutils\EntityDataIntegrityException;

/**
 * @ORM\Entity(repositoryClass="Vittascience\Repository\Vlearn\RepositoryCourseLinkCourse")
 * @ORM\Table(name="learn_tutorials_link_tutorials",
 *   uniqueConstraints={
 *       @ORM\UniqueConstraint(name="couple_tutorial_unique", columns={"tutorial1_id", "tutorial2_id"})
 *   }
 *  )
 */
class CourseLinkCourse
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="related")
     */
    private $tutorial1;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="related")
     */
    private $tutorial2;

    public function __construct($tutorial1, $tutorial2)
    {
        $this->tutorial1 = $tutorial1;
        $this->tutorial2 = $tutorial2;
    }

    public function getCourse1()
    {
        return $this->tutorial1;
    }

    public function setCourse1($tutorial1)
    {
        if ($tutorial1 instanceof Course || $tutorial1 == null) {
            $this->tutorial1 = $tutorial1;
        } else {
            throw new EntityDataIntegrityException("tutorial attribute needs to be an instance of Course or null");
        }
    }

    public function getCourse2()
    {
        return $this->tutorial2;
    }

    public function setCourse2($tutorial2)
    {
        if ($tutorial2 instanceof Course || $tutorial2 == null) {
            $this->tutorial2 = $tutorial2;
        } else {
            throw new EntityDataIntegrityException("tutorial attribute needs to be an instance of Course or null");
        }
    }
}
