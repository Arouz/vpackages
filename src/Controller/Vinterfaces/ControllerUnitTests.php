<?php

namespace Vittascience\Controller\Vinterfaces;

use Vittascience\Entity\Vinterfaces\UnitTests;
use Vittascience\Entity\Vinterfaces\ExercisePython;


class ControllerUnitTests extends Controller
{
    public function __construct($entityManager, $user)
    {
        parent::__construct($entityManager, $user);
        $this->actions = array(
            'get_by_exercise' => function ($data) {
                $exerciseDeseralized = ExercisePython::jsonDeserialize($data['exercise']);
                $exerciseSynchronized = $this->entityManager->getRepository(ExercisePython::class)
                    ->findBy(array("id" => $exerciseDeseralized->getId()));
                return $this->entityManager->getRepository(UnitTests::class)
                    ->findBy(array("exercise" => $exerciseSynchronized));
            },
            "update" => function ($data) {
                $unitTest = UnitTests::jsonDeserialize($data['test']);
                $unitTest->setExercise(ExercisePython::jsonDeserialize($unitTest->getExercise()));

                $databaseUnitTest = $this->entityManager->getRepository(UnitTests::class)->find($unitTest->getId());
                if ($databaseUnitTest === null) {
                    $exercise = $this->entityManager->getRepository(ExercisePython::class)
                        ->find(intval($unitTest->getExercise()->getId()));
                    $unitTest->setExercise($exercise);
                } else {
                    $databaseUnitTest->copy($unitTest);
                    $unitTest = $databaseUnitTest;
                }
                $this->entityManager->persist($unitTest);
                $this->entityManager->flush();

                return $unitTest;
            },
            "delete" => function ($data) {
                $databaseInput = $this->entityManager->getRepository(UnitTests::class)->find($data['test']);
                $this->entityManager->remove($databaseInput);
                $this->entityManager->flush();
            }
        );
    }

    public function action($action, $data = [], $async = false)
    {
        if ($async)
            echo (json_encode(call_user_func($this->actions[$action], $data)));
    }
}
