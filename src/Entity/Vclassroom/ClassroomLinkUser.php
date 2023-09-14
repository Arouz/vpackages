<?php

namespace Vittascience\Entity\Vclassroom;

use Doctrine\ORM\Mapping as ORM;
use Vittascience\Entity\Vuser\User;
use Vittascience\Entity\Vclassroom\Classroom;
use Vittascience\Exceptions\Vutils\EntityDataIntegrityException;

/**
 * @ORM\Entity(repositoryClass="Vittascience\Repository\Vclassroom\ClassroomLinkUserRepository")
 * @ORM\Table(name="classroom_users_link_classrooms")
 */
class ClassroomLinkUser implements \JsonSerializable, \Vittascience\JsonDeserializer
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Vittascience\Entity\Vuser\User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @var User
     */
    private $user;
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Vittascience\Entity\Vclassroom\Classroom")
     * @ORM\JoinColumn(name="id_classroom", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @var Classroom
     */
    private $classroom;
    /**
     * @ORM\Column(name="rights", type="integer", length=2, nullable=true)
     * 0=student, 1=teacher, 2=superadmin
     * @var integer
     */
    private $rights;
    public function __construct(User $user, Classroom $classroom, $rights = 0)
    {
        $this->setUser($user);
        $this->setClassroom($classroom);
        $this->setRights($rights);
    }
    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @param User $user
     */
    public function setUser($user)
    {
        if ($user instanceof User) {
            $this->user = $user;
        } else {
            throw new EntityDataIntegrityException("user attribute needs to be an instance of User");
        }
    }
    /**
     * @return Classroom 
     */
    public function getClassroom()
    {
        return $this->classroom;
    }
    /**
     * @param Classroom $classroom
     */
    public function setClassroom($classroom)
    {
        if ($classroom instanceof Classroom) {
            $this->classroom = $classroom;
        } else {
            throw new EntityDataIntegrityException("classroom attribute needs to be an instance of Classroom");
        }
    }
    /**
     * @return int
     */
    public function getRights()
    {
        return $this->rights;
    }
    /**
     * @param int $rights
     */
    public function setRights($rights)
    {
        if (is_int($rights) && $rights >= 0 && $rights <= 2) {
            $this->rights = $rights;
        } else
            throw new EntityDataIntegrityException("id needs to be integer and between 0 and 2");
    }
    public function jsonSerialize()
    {
        return [
            'user' => $this->getUser()->jsonSerialize(),
            'classroom' => $this->getClassroom()->jsonSerialize(),
            'rights' => $this->getRights(),
        ];
    }

    public static function jsonDeserialize($jsonDecoded)
    {
        $classInstance = new self(new User(), new Classroom("aaaaa"));
        foreach ($jsonDecoded as $attributeName => $attributeValue) {
            $classInstance->{$attributeName} = $attributeValue;
        }
        return $classInstance;
    }
}
