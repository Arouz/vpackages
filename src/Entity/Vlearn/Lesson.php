<?php

namespace Vittascience\Entity\Vlearn;

use Doctrine\ORM\Mapping as ORM;
use Vittascience\Exceptions\Vutils\EntityDataIntegrityException;

/**
 * @ORM\Entity(repositoryClass="Vittascience\Repository\Vlearn\RepositoryLesson")
 * @ORM\Table(name="learn_chapters_link_tutorials",
 *   uniqueConstraints={
 *       @ORM\UniqueConstraint(name="chapter_tutorial_unique", columns={"chapter_id", "tutorial_id"})
 *   }
 *  )
 */
class Lesson
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Chapter::class, inversedBy="lesson")
     */
    private $chapter;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="lesson")
     */
    private $tutorial;


    public function getChapter()
    {
        return $this->chapter;
    }

    public function setChapter($chapter)
    {
        if ($chapter instanceof Chapter || $chapter == null) {
            $this->chapter = $chapter;
        } else {
            throw new EntityDataIntegrityException("chapter attribute needs to be an instance of Chapter or null");
        }
    }

    public function getCourse()
    {
        return $this->tutorial;
    }

    public function setCourse($tutorial)
    {
        if ($tutorial instanceof Course || $tutorial == null) {
            $this->tutorial = $tutorial;
        } else {
            throw new EntityDataIntegrityException("tutorial attribute needs to be an instance of Course or null");
        }
    }
}
