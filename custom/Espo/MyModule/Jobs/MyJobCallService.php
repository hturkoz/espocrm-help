<?php

namespace Espo\Modules\MyModule\Jobs;

use Espo\Core\ORM\EntityManager;
use Espo\Core\Job\Job;
use Espo\Core\Job\Job\Data;
use Espo\Core\Utils\Log;

use Espo\Core\InjectableFactory;
use Espo\Modules\MyModule\Services\MyService;

class MyJobCallService implements Job 
{
    private $entityManager;
    private $log;
    private $injectableFactory;
   
    public function __construct( 
        EntityManager $entityManager,
        InjectableFactory $injectableFactory,
        Log $log
    )
    {
        $this->entityManager = $entityManager;
        $this->injectableFactory = $injectableFactory;
        $this->log = $log;
    }
   
    public function run(Data $data) : void
    {
        $this->log->error("MyJobCallService::run");
        $myData = Data::create([
                    'myValue' => 'MyJobCallService::run',
                    'targetId' => '1',
                    'targetType' => 'Account'
                ]);
        
        $injectableFactory = $this->injectableFactory;
        $injectableFactory->create(MyService::class)->process( $myData->getRaw() );
    }
}