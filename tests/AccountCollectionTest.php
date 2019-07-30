<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tinkoff\Business\Model\Account;
use Tinkoff\Business\Model\AccountCollection;

final class AccountCollectionTest extends TestCase
{
    public function testShouldReturnAccountByNumber(): void
    {
        $data = [
            [
                'accountNumber' => '40101810900000000974',
                'status' => 'Normal',
                'name' => 'Основной счет',
                'currency' => '643',
                'balance' => [
                    'otb' => 235797.4,
                    'authorized' => 0,
                    'pendingPayments' => 0,
                    'pendingRequisitions' => 0
                ]
            ],
            [
                'accountNumber' => '40101810900000001000',
                'status' => 'Normal',
                'name' => 'Дополнительный счет',
                'currency' => '643',
                'balance' => [
                    'otb' => 235797.4,
                    'authorized' => 0,
                    'pendingPayments' => 0,
                    'pendingRequisitions' => 0
                ]
            ]
        ];

        $collection = new AccountCollection();
        foreach ($data as $item) {
            $account = Account::createFromArray($item);

            $collection->add($account);
        }

        $account = $collection->getByAccountNumber('40101810900000000974');

        $this->assertSame($data[0]['accountNumber'], $account->getAccountNumber());
        $this->assertSame($data[0]['status'], $account->getStatus());
        $this->assertSame($data[0]['name'], $account->getName());
        $this->assertEquals($data[0]['currency'], $account->getCurrency());
        $this->assertEquals($data[0]['balance']['otb'], $account->getBalance()->getOtb());
        $this->assertEquals($data[0]['balance']['authorized'], $account->getBalance()->getAuthorized());
        $this->assertEquals($data[0]['balance']['pendingPayments'], $account->getBalance()->getPendingPayments());
        $this->assertEquals($data[0]['balance']['pendingRequisitions'],
            $account->getBalance()->getPendingRequisitions());
    }

}
