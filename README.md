# espocrm-help


It's my helper/tooltips for : https://github.com/espocrm 

1) MyCommand : console command

```php
	php bin/command my-command
	php bin/command my-command espoCRM
```

2) MyJobWithData : job with data as classes 

```php
	use Espo\Core\Job\JobSchedulerFactory;
	use Espo\Core\Job\QueueName;

	/** @var JobSchedulerFactory $jobSchedulerFactory */ JobSchedulerFactory as a constructor dependency

	$jobClassName = 'MyJobWithData';
	$jobSchedulerFactory->create()
	    ->setClassName($jobClassName) // should implement `Espo\Core\Job\Job` interface
	    ->setQueue(QueueName::Q0) // optional
	    ->setGroup('some-group-name') // optional string Jobs within a group will run one-by-one.
	    ->setData([
	        'entityType' => 'Account',
	        'entityId' => '1'
	    ])
	    ->schedule();
```

3) MyJobDataLess : job without data

```php
        $job = $em->createEntity('Job', [
                'name' => 'MyJobDataLess',
                'status' => 'Pending',
                'serviceName' => 'MyJobDataLess',
                'methodName' => 'run',
                'executeTime' => date('Y-m-d H:i:s'),
    			'queue' => 'q0'
        ]);
```

4) MyJobCallService : call service from job

5) ip behind proxy

change $request->getServerParam('REMOTE_ADDR') to  $request->getServerParam('HTTP_X_REAL_IP') in application/Espo/Core/Authentication.php
