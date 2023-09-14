<?php

namespace Vittascience\Controller\Vlearn;

class ControllerCollection extends Controller
{
    public function __construct($entityManager, $user)
    {
        parent::__construct($entityManager, $user);
        $this->actions = array(
            'get_all' => function () {
                $arrayResult = $this->entityManager->getRepository(Collection::class)->findAll();
                return  $arrayResult;
            },
            'get_one' => function ($data) {
                return $this->entityManager->getRepository(Collection::class)->findBy(array("id" => $data['id']));
            }
        );
    }
}
