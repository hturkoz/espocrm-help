# espocrm-help

how-to

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
	    ->setGroup('some-group-name') // optional
	    ->setData([
	        'entityType' => 'Account',
	        'entityId' => '1'
	    ])
	    ->schedule();
```