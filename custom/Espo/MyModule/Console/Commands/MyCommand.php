<?php
namespace Espo\Modules\MyModule\Console\Commands;

use Espo\Core\Exceptions\Error;
use Espo\Core\Console\IO;

class MyCommand extends \Espo\Core\Console\Commands\Base
{
	protected $io;

	public function __construct(IO $io)
	{
		$this->io = $io;
	}

	public function run(array $options, array $flagList, array $argumentList) : void
	{
		$name = $argumentList[0] ?? null;
		
		if ($name){
			
			$this->io->writeLine('Your name is : ' .$name);
		
		}else{
			
			$this->io->writeLine("Please give your name.");
			$name = $this->io->readLine();
		}

		if (!$name) {
			
			throw new Error('Invalid argument. Please give your name');
		}
		
		$this->io->writeLine('Hello ' .$name);
		$this->io->writeLine("1) Your name is {$name} right?");
		$this->io->writeLine("2) What is my name?" );
		$this->io->writeLine("Select 1 or 2 or return for cancel.");

		$response = $this->io->readLine();
		switch ($response){
			case 1 :
				
				$this->io->writeLine("Yes.. no complicate !");
				break;
			case 2 :
				
				$whoAmi = @exec('whoami');
				$this->io->writeLine($whoAmi);
				break;
			default:
				
				$this->io->writeLine("Canceled.");
				return;
		}
		
		$this->io->writeLine("Done.");
	}
}