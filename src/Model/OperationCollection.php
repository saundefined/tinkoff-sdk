<?php

namespace Tinkoff\Business\Model;

use Tinkoff\Business\Base\BaseCollection;

class OperationCollection extends BaseCollection
{
    public function add(Operation $operationItem): void
    {
        parent::add($operationItem);
    }

}