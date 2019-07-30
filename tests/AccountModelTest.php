<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tinkoff\Business\Model\Account;

final class AccountModelTest extends TestCase
{
    public function testShouldReturnAccountFromArray(): void
    {
        $data = [
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
        ];

        $account = Account::createFromArray($data);

        $this->assertSame($data['accountNumber'], $account->getAccountNumber());
        $this->assertSame($data['status'], $account->getStatus());
        $this->assertSame($data['name'], $account->getName());
        $this->assertEquals($data['currency'], $account->getCurrency());
        $this->assertEquals($data['balance']['otb'], $account->getBalance()->getOtb());
        $this->assertEquals($data['balance']['authorized'], $account->getBalance()->getAuthorized());
        $this->assertEquals($data['balance']['pendingPayments'], $account->getBalance()->getPendingPayments());
        $this->assertEquals($data['balance']['pendingRequisitions'], $account->getBalance()->getPendingRequisitions());
    }
}
