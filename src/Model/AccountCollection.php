<?php

namespace Tinkoff\Business\Model;

use Tinkoff\Business\Base\BaseCollection;
use Tinkoff\Business\Exception\OutOfRangeException;

class AccountCollection extends BaseCollection
{
    /**
     * @param string $accountNumber
     *
     * @return \Tinkoff\Business\Base\BaseModel|Account
     *
     * @throws OutOfRangeException
     */
    public function getByAccountNumber($accountNumber)
    {
        return $this->find(function ($account) use ($accountNumber) {
            /** @var Account $account */
            return $account->getAccountNumber() === $accountNumber;
        });
    }

}