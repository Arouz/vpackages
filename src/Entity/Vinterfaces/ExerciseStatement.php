<?php

namespace Vittascience\Entity\Vinterfaces;

use Doctrine\ORM\Mapping as ORM;
use Vittascience\Exceptions\Vutils\EntityDataIntegrityException;

/**
 * @ORM\Entity(repositoryClass="Vittascience\Repository\Vinterfaces\ExerciseStatementRepository")
 * @ORM\Table(name="interfaces_exercise_statements")
 */
class ExerciseStatement implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(name="statement_content", type="text", nullable=false)
     */
    private $statementContent;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of statementContent
     *
     * @return  string
     */
    public function getStatementContent()
    {
        return htmlspecialchars_decode($this->statementContent);
    }

    /**
     * Set the value of statementContent
     *
     * @param  string  $statementContent
     *
     * @return  self
     */
    public function setStatementContent($statementContent)
    {
        if(!is_string($statementContent)){
            throw new EntityDataIntegrityException("The statement content has to be a string");
        }

        $this->statementContent = $statementContent;

        return $this;
    }

    /**
     * convert doctrine object into array
     *
     * @return  array  
     */
    public function jsonSerialize()
    {
        return array(
            'id' => $this->getId(),
            'statementContent' => $this->getStatementContent()
        );
    }
}
