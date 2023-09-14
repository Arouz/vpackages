<?php

namespace Vittascience\Controller\Vinterfaces;

use Vittascience\Entity\Vinterfaces\UnitTests;
use Vittascience\Entity\Vinterfaces\UnitTestsOutputs;

class ControllerUnitTestsOutputs extends Controller
{
    public function __construct($className, $user)
    {
        parent::__construct($className, $user);
        $this->actions = array(
            'get_by_unittest' => function ($data) {
                $testDeseralized = UnitTests::jsonDeserialize($data['unitTest']);
                $testSynchronized = $this->entityManager->getRepository(UnitTests::class)
                    ->findBy(array("id" => $testDeseralized->getId()));
                return $this->entityManager->getRepository(UnitTestsOutputs::class)
                    ->findBy(array("unitTest" => $testSynchronized));
            },
            "update" => function ($data) {
                $idTabToReturn = [];
                for ($i = 0; $i < count($data['iO']); $i++) {
                    $output = UnitTestsOutputs::jsonDeserialize($data['iO'][$i]);
                    $output->setUnitTest(UnitTests::jsonDeserialize(json_decode($output->getUnitTest())));
                    $databaseOutput = $this->entityManager->getRepository(UnitTestsOutputs::class)->find($output->getId());
                    if ($databaseOutput === null) {
                        $test = $this->entityManager->getRepository(UnitTests::class)
                            ->find(intval($output->getUnitTest()->getId()));
                        $output->setUnitTest($test);
                    } else {
                        $databaseOutput->copy($output);
                        $output = $databaseOutput;
                    }

                    $this->entityManager->persist($output);
                    $this->entityManager->flush();
                    $idTabToReturn[$i] = $output;

                }
                return $idTabToReturn;
            },
            "delete" => function ($data) {
                for ($i = 0; $i < count($data['iO']); $i++) {
                    $databaseOutput = $this->entityManager->getRepository(UnitTestsOutputs::class)->find($data['iO'][$i]);
                    if($databaseOutput){
                        $this->entityManager->remove($databaseOutput);
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
