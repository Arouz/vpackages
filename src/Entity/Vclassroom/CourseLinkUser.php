<?php

namespace Vittascience\Entity\Vclassroom;

use Doctrine\ORM\Mapping as ORM;
use Vittascience\Entity\Vuser\User;
use Vittascience\Entity\Vlearn\Course;

/**
 * @ORM\Entity(repositoryClass="Vittascience\Repository\Vclassroom\CourseLinkUserRepository")
 * @ORM\Table(name="classroom_users_link_courses")
 */
class CourseLinkUser implements \JsonSerializable, \Vittascience\JsonDeserializer
{

    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Vittascience\Entity\Vuser\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @var User
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Vittascience\Entity\Vlearn\Course")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @var User
     */
    private $course;

     /**
     * @ORM\Column(name="activities_data", type="text", nullable=true)
     * @var String
     */
    private $activitiesData;

    /**
     * @ORM\Column(name="date_begin", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $dateBegin;

    /**
     * @ORM\Column(name="date_end", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $dateEnd;

    /**
     * @ORM\Column(name="course_state", type="integer", nullable=false)
     * @var int
     */
    private $courseState;


    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getCourse()
    {
        return $this->course;
    }

    public function setCourse(Course $course)
    {
        $this->course = $course;
    }

    public function getActivitiesData()
    {
        return $this->activitiesData;
    }

    public function setActivitiesData($activitiesData)
    {
        $this->activitiesData = $activitiesData;
    }

    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    public function setDateBegin(?\DateTime $dateBegin)
    {
        $this->dateBegin = $dateBegin;
    }

    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTime $dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }

    public function getCourseState()
    {
        return $this->courseState;
    }

    public function setCourseState($courseState)
    {
        $this->courseState = $courseState;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'user' => $this->user,
            'course' => $this->course,
            'activitiesData' => $this->activitiesData,
            'dateBegin' => $this->dateBegin,
            'dateEnd' => $this->dateEnd,
            'courseState' => $this->courseState
        ];
    }

    public static function jsonDeserialize($jsonDecoded)
    {
        $classInstance = new self();
        foreach ($jsonDecoded as $attributeName => $attributeValue) {
            $classInstance->{$attributeName} = $attributeValue;
        }
        return $classInstance;
    }
}
