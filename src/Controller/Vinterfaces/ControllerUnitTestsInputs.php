<?php

namespace Vittascience\Controller\Vinterfaces;

use Vittascience\Entity\Vinterfaces\UnitTests;
use Vittascience\Entity\Vinterfaces\UnitTestsInputs;


class ControllerUnitTestsInputs extends Controller
{
    public function __construct($className, $user)
    {
        parent::__construct($className, $user);
        $this->actions = array(
            'get_by_unittest' => function ($data) {
                $testDeseralized = UnitTests::jsonDeserialize($data['unitTest']);
                $testSynchronized = $this->entityManager->getRepository(UnitTests::class)
                    ->findBy(array("id" => $testDeseralized->getId()));
                return $this->entityManager->getRepository(UnitTestsInputs::class)
                    ->findBy(array("unitTest" => $testSynchronized));
            },
            "update" => function ($data) {
                $idTabToReturn = [];
                for ($i = 0; $i < count($data['iO']); $i++) {
                    $input = UnitTestsInputs::jsonDeserialize($data['iO'][$i]);
                    $input->setUnitTest(UnitTests::jsonDeserialize(json_decode($input->getUnitTest())));
                    $databaseInput = $this->entityManager->getRepository(UnitTestsInputs::class)->find($input->getId());
                    if ($databaseInput === null) {
                        $test = $this->entityManager->getRepository(UnitTests::class)
                            ->find(intval($input->getUnitTest()->getId()));
                        $input->setUnitTest($test);
                    } else {
                        $databaseInput->copy($input);
                        $input = $databaseInput;
                    }

                    $this->entityManager->persist($input);
                    $this->entityManager->flush();
                    $idTabToReturn[$i] = $input;
                }
                return $idTabToReturn;
            },
            "delete" => function ($data) {
                for ($i = 0; $i < count($data['iO']); $i++) {
                    $databaseInput = $this->entityManager->getRepository(UnitTestsInputs::class)->find(intVal($data['iO'][$i]));
                    if($databaseInput){
                        $this->entityManager->remove($databaseInput);
                    }
                }
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
