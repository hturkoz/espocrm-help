<?php
namespace Espo\Modules\MyModule\Classes\Select\Account\PrimaryFilters;

use Espo\Core\Select\Primary\Filter;
use Espo\ORM\Query\SelectBuilder;
use Espo\ORM\Query\Part\Condition as Cond;

class Active implements Filter
{
	public function apply(SelectBuilder $queryBuilder): void
	{
		$queryBuilder->where(
			Cond::in(
				Cond::column('status'), ['Active']
			)
		);
	}
}