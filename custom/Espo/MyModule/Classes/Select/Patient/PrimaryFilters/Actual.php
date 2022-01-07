<?php
namespace Espo\MyModule\Classes\Select\Patient\PrimaryFilters;

use Espo\Core\Select\Primary\Filter;
use Espo\ORM\Query\SelectBuilder;
use Espo\ORM\Query\Part\Condition as Cond;

class Actual implements Filter 
{
	public function apply(SelectBuilder $queryBuilder): void
	{
		$queryBuilder->where(
			Cond::in(
			Cond::column('status'), ['Actif','Waiting'] )
		);
	}
}