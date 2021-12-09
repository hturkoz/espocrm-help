<?php

namespace Espo\Modules\MyModule\Jobs;

use Espo\Core\ORM\EntityManager;
use Espo\Core\Job\Job;
use Espo\Core\Job\Job\Data;

class MyJobWithData implements Job 
{
    private $entityManager;
   
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
   
    public function run(Data $data) : void
    {
        $entityType = $data->get('entityType');
        $entityId = $data->get('entityId');

        $entity = $this->entityManager->getEntity($entityType, $entityId);
    }
}