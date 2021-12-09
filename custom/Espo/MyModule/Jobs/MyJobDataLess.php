<?php

namespace Espo\Modules\MyModule\Jobs;

use Espo\Core\ORM\EntityManager;
use Espo\Core\ORM\Job\JobDataLess;

class MyJobDataLess implements JobDataLess
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function run(): void
    {
        
    }
}
