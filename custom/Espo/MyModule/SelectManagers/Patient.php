<?php

namespace Espo\Modules\MyModule\SelectManagers;

class Patient extends \Espo\Core\SelectManagers\Base
{

    protected function boolFilterOnlyUsers(&$result)
    {
        $wherePart = null;
        if ($this->getSeed()->hasRelation('assignedsUsers')) {
            $this->setDistinct(true, $result);
            $this->addLeftJoin(['assignedsUsers', 'assignedsUsersOnlyMyFilter'], $result);
            $wherePart = [
                'assignedsUsersOnlyMyFilter.id' => $this->getUser()->id
            ];
        } 

        return $wherePart;
    }

    protected function boolFilterR2(&$result)
    {
        $wherePart = null;
        if ($this->getSeed()->hasRelation('assignedsUsers')) {
            $this->setDistinct(true, $result);
            $this->addLeftJoin(['assignedsUsers', 'assignedsUsersOnlyMyFilter'], $result);
            $wherePart = [
                'assignedsUsersOnlyMyFilter.id' => $this->getUser()->id,
                'assignedsUsersOnlyMyFilterMiddle.role' => 'R2'
            ];
        } 

        return $wherePart;
    }

    protected function boolFilterR3(&$result)
    {
        $wherePart = null;
        if ($this->getSeed()->hasRelation('assignedsUsers')) {
            $this->setDistinct(true, $result);
            $this->addLeftJoin(['assignedsUsers', 'assignedsUsersOnlyMyFilter'], $result);
            $wherePart = [
                'assignedsUsersOnlyMyFilter.id' => $this->getUser()->id,
                'assignedsUsersOnlyMyFilterMiddle.role' => 'R3'
            ];
        } 

        return $wherePart;
    }

}