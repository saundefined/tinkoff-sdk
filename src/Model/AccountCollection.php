<?php

namespace Tinkoff\Business\Model;

use Tinkoff\Business\Base\BaseCollection;
use Tinkoff\Business\Exception\OutOfRangeException;

class AccountCollection extends BaseCollection
{
    /**
     * @param string $accountNumber
     *
     * @return Account
     *
     * @throws OutOfRangeException
     */
    public function getByAccountNumber($accountNumber): Account
    {
        return $this->find(static function ($account) use ($accountNumber) {
            /** @var Account $account */
            return $account->getAccountNumber() === $accountNumber;
        });
    }

}
