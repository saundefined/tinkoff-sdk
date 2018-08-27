<?php

namespace Tinkoff\Business\Model;

use Tinkoff\Business\Base\BaseCollection;
use Tinkoff\Business\Exception\NotFoundException;

class AccountCollection extends BaseCollection
{
    public function add(Account $accountItem): void
    {
        parent::add($accountItem);
    }

    /**
     * @param string $accountNumber
     *
     * @return Account
     *
     * @throws NotFoundException
     */
    public function getByAccountNumber($accountNumber): Account
    {
        /** @var Account $account */
        foreach ($this->getArray() as $account) {
            if ($account->getAccountNumber() === $accountNumber) {
                return $account;
            }
        }

        throw new NotFoundException('Account ' . $accountNumber . ' not found');
    }

}