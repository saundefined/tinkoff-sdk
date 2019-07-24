<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SprintBox\Api\Model\Snapshot;
use Tinkoff\Business\Model\Account;

final class AccountTest extends TestCase
{
    private $collection = [];

    public function testShouldReturnCollection(): void
    {
        $client = $this->createClient($this->collection);
        $collection = $client->accounts()->get();

        $this->assertSame(2, $collection->count());

        $item = $collection->current();

        $this->assertAccount($item);

    }

    private function createClient($data = []): \Tinkoff\Business\Client
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode($data))
        ]);
        $handler = HandlerStack::create($mock);

        $client = new \Tinkoff\Business\Client('760000000000');
        $client->setClient(new Client(['handler' => $handler]));
        $client->setAccessToken('MZlKw2FjKp3i1sD4hs2CxEeqzmfBdFEHSDQbFcYQoz7DLoBZyiYDFQ4JoTPs5jnZfL7O0JpLQRUWeNK1lFxH9Y');

        return $client;
    }

    private function assertAccount(Account $account): void
    {
        $this->assertSame($this->collection[0]['accountNumber'], $account->getAccountNumber());
        $this->assertSame($this->collection[0]['status'], $account->getStatus());
        $this->assertSame($this->collection[0]['name'], $account->getName());
        $this->assertEquals($this->collection[0]['currency'], $account->getCurrency());
        $this->assertEquals($this->collection[0]['balance']['otb'], $account->getBalance()->getOtb());
        $this->assertEquals($this->collection[0]['balance']['authorized'], $account->getBalance()->getAuthorized());
        $this->assertEquals($this->collection[0]['balance']['pendingPayments'],
            $account->getBalance()->getPendingPayments());
        $this->assertEquals($this->collection[0]['balance']['pendingRequisitions'],
            $account->getBalance()->getPendingRequisitions());

    }

    protected function setUp(): void
    {
        $this->collection = [
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
    }
}
