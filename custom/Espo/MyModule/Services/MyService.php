<?php

namespace Espo\Modules\MyModule\Services;

use Espo\Core\ORM\EntityManager;

use Espo\Core\Utils\Log;

use stdClass;

class MyService 
{
    private $entityManager;
    private $log;
    private $data;

    public function __construct( 
        EntityManager $entityManager, 
        Log $log
    )
    {
        $this->entityManager = $entityManager;
        $this->log = $log;
    }
   
    public function process(stdClass $data) : void
    {
        $this->log->error("MyService::process");
        $account = $this->entityManager->getEntity($data->targetType );
        $account->set([
            'name' => $data->myValue .' at ' .date('Y-m-d H:i:s'),
            ]);

        $this->entityManager->saveEntity($account);  
    }
}