<?php

namespace Tinkoff\Business\Model;

use Tinkoff\Business\Base\BaseCollection;

class AccountCollection extends BaseCollection
{
    public function add(Account $accountItem): void
    {
        parent::add($accountItem);
    }

}