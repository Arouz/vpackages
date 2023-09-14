<?php

namespace Vittascience\Entity\Vlearn;

use Doctrine\ORM\Mapping as ORM;
use Vittascience\Entity\Vuser\User;
use Vittascience\Exceptions\Vutils\EntityDataIntegrityException;

/**
 * @ORM\Entity(repositoryClass="Vittascience\Repository\Vlearn\RepositoryFavorite")
 * @ORM\Table(name="learn_favorites",
 *   uniqueConstraints={
 *       @ORM\UniqueConstraint(name="user_tutorial_unique", columns={"user_id", "tutorial_id"})
 *   }
 *  )
 */
class Favorite
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Vittascience\Entity\Vuser\User", inversedBy="favorite")
     */
    private $user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="favorite")
     */
    private $tutorial;


    public function __construct($user, $tutorial)
    {
        $this->user = $user;
        $this->tutorial = $tutorial;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        if ($user instanceof User || $user == null) {
            $this->user = $user;
        } else {
            throw new EntityDataIntegrityException("user attribute needs to be an instance of User or null");
        }
    }

    public function getTutorial()
    {
        return $this->tutorial;
    }

    public function setTutorial($tutorial)
    {
        if ($tutorial instanceof Course || $tutorial == null) {
            $this->tutorial = $tutorial;
        } else {
            throw new EntityDataIntegrityException("tutorial attribute needs to be an instance of Course or null");
        }
    }
}
