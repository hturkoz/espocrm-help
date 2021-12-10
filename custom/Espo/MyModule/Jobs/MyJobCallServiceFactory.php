<?php

namespace Espo\Modules\MyModule\Jobs;

use Espo\Core\ORM\EntityManager;
use Espo\Core\Job\Job;
use Espo\Core\Job\Job\Data;
use Espo\Core\Utils\Log;

use Espo\Core\ServiceFactory;

class MyJobCallServiceFactory implements Job 
{
    private $entityManager;
    private $log;
    private $serviceFactory;
   
    public function __construct( 
        EntityManager $entityManager,
        Log $log,
        ServiceFactory $serviceFactory
    )
    {
        $this->entityManager = $entityManager;
        $this->log = $log;
        $this->serviceFactory = $serviceFactory;

    }
   
    public function run(Data $data) : void
    {
        $this->log->error("MyJobCallService::run");
        $myData = Data::create([
                    'myValue' => 'MyJobCallService::run',
                    'targetId' => '1',
                    'targetType' => 'Account'
                ]);

        $myService = $this->serviceFactory->create('MyService');
        $myService->process( $myData->getRaw() );

        $this->log->error( $myService->returnValue( 'this' ) );
    }
}