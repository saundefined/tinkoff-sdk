<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SprintBox\Api\Model\Snapshot;
use Tinkoff\Business\Model\Account;
use Tinkoff\Business\Model\Operation;

final class OperationTest extends TestCase
{
    private $collection = [];

    public function testShouldReturnCollection(): void
    {
        $client = $this->createClient($this->collection);

        $account = new Account();
        $account->setAccountNumber('40101810900000000974');

        $collection = $client->operations($account)->get();

        $this->assertSame(2, $collection->count());

        $item = $collection->current();

        $this->assertOperation($item);
    }

    private function createClient($data = []): \Tinkoff\Business\Client
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'operation' => $data
            ]))
        ]);
        $handler = HandlerStack::create($mock);

        $client = new \Tinkoff\Business\Client('760000000000');
        $client->setClient(new Client(['handler' => $handler]));
        $client->setAccessToken('MZlKw2FjKp3i1sD4hs2CxEeqzmfBdFEHSDQbFcYQoz7DLoBZyiYDFQ4JoTPs5jnZfL7O0JpLQRUWeNK1lFxH9Y');

        return $client;
    }

    private function assertOperation(Operation $operation): void
    {
        $this->assertSame($this->collection[0]['id'], $operation->getId());
        $this->assertSame($this->collection[0]['date'], $operation->getDate()->format('Y-m-d'));
        $this->assertEquals($this->collection[0]['amount'], $operation->getAmount());
        $this->assertEquals($this->collection[0]['drawDate'], $operation->getDrawDate()->format('Y-m-d'));

        $payer = $operation->getPayer();
        $this->assertSame($this->collection[0]['payerName'], $payer->getName());
        $this->assertSame($this->collection[0]['payerInn'], $payer->getInn());
        $this->assertSame($this->collection[0]['payerKpp'], $payer->getKpp());

        $payerBank = $payer->getBank();
        $this->assertSame($this->collection[0]['payerAccount'], $payerBank->getAccountNumber());
        $this->assertSame($this->collection[0]['payerCorrAccount'], $payerBank->getCorrAccount());
        $this->assertSame($this->collection[0]['payerBic'], $payerBank->getBic());
        $this->assertSame($this->collection[0]['payerBank'], $payerBank->getName());

        $this->assertSame($this->collection[0]['chargeDate'], $operation->getChargeDate()->format('Y-m-d'));

        $recipient = $operation->getRecipient();
        $this->assertSame($this->collection[0]['recipient'], $recipient->getName());
        $this->assertSame($this->collection[0]['recipientInn'], $recipient->getInn());
        $this->assertSame($this->collection[0]['recipientKpp'], $recipient->getKpp());

        $recipientBank = $recipient->getBank();
        $this->assertSame($this->collection[0]['recipientAccount'], $recipientBank->getAccountNumber());
        $this->assertSame($this->collection[0]['recipientCorrAccount'], $recipientBank->getCorrAccount());
        $this->assertSame($this->collection[0]['recipientBic'], $recipientBank->getBic());
        $this->assertSame($this->collection[0]['recipientBank'], $recipientBank->getName());

        $this->assertSame($this->collection[0]['paymentType'], $operation->getPaymentType());
        $this->assertSame($this->collection[0]['operationType'], $operation->getOperationType());
        $this->assertSame($this->collection[0]['uin'], $operation->getUin());
        $this->assertSame($this->collection[0]['paymentPurpose'], $operation->getPaymentPurpose());
        $this->assertSame($this->collection[0]['creatorStatus'], $operation->getCreatorStatus());
        $this->assertSame($this->collection[0]['creatorStatus'], $operation->getCreatorStatus());

        $this->assertSame($this->collection[0]['kbk'], $operation->getKbk());
        $this->assertSame($this->collection[0]['oktmo'], $operation->getOktmo());

        $tax = $operation->getTax();
        $this->assertSame($this->collection[0]['taxEvidence'], $tax->getEvidence());
        $this->assertSame($this->collection[0]['taxPeriod'], $tax->getPeriod());
        $this->assertSame($this->collection[0]['taxDocNumber'], $tax->getNumber());
        $this->assertSame($this->collection[0]['taxDocDate'], $tax->getDate()->format('Y-m-d'));
        $this->assertSame($this->collection[0]['taxType'], $tax->getType());

        $this->assertSame($this->collection[0]['executionOrder'], $operation->getExecutionOrder());
    }

    public function testShouldReturnCollectionByDate(): void
    {
        $client = $this->createClient($this->collection);

        $account = new Account();
        $account->setAccountNumber('40101810900000000974');

        $collection = $client->operations($account)->get(new DateTime('2019-01-01'), new DateTime('2019-02-01'));

        $this->assertSame(2, $collection->count());

        $item = $collection->current();

        $this->assertOperation($item);
    }

    protected function setUp(): void
    {
        $this->collection = [
            [
                'id' => '3000000001',
                'date' => date('Y-m-d'),
                'amount' => 25000,
                'drawDate' => date('Y-m-d'),
                'payerName' => 'Payer',
                'payerInn' => '1111111111',
                'payerAccount' => '40101810900000000974',
                'payerCorrAccount' => '',
                'payerBic' => '987654320',
                'payerBank' => 'АО "ТИНЬКОФФ БАНК"',
                'chargeDate' => date('Y-m-d'),
                'recipient' => 'Receiver',
                'recipientInn' => '2222222222',
                'recipientAccount' => '40101810900000000974',
                'recipientCorrAccount' => '',
                'recipientBic' => '044525974',
                'recipientBank' => 'АО "ТИНЬКОФФ БАНК"',
                'paymentType' => 'Оплата контрагенту',
                'operationType' => '17',
                'uin' => '',
                'paymentPurpose' => 'testPurpose',
                'creatorStatus' => '',
                'payerKpp' => '987654321',
                'recipientKpp' => '770000000',
                'kbk' => '18210202103081013160',
                'oktmo' => '78701000',
                'taxEvidence' => 'ГД',
                'taxPeriod' => '2019',
                'taxDocNumber' => '15',
                'taxDocDate' => date('Y-m-d'),
                'taxType' => 'НС',
                'executionOrder' => '5'
            ],
            [
                [
                    'id' => '3000000002',
                    'date' => date('Y-m-d'),
                    'amount' => 30000,
                    'drawDate' => date('Y-m-d'),
                    'payerName' => 'Payer',
                    'payerInn' => '1111111111',
                    'payerAccount' => '40101810900000000974',
                    'payerCorrAccount' => '',
                    'payerBic' => '987654320',
                    'payerBank' => 'АО "ТИНЬКОФФ БАНК"',
                    'chargeDate' => date('Y-m-d'),
                    'recipient' => 'Receiver',
                    'recipientInn' => '2222222222',
                    'recipientAccount' => '40101810900000000974',
                    'recipientCorrAccount' => '',
                    'recipientBic' => '044525974',
                    'recipientBank' => 'АО "ТИНЬКОФФ БАНК"',
                    'paymentType' => 'Оплата контрагенту',
                    'operationType' => '17',
                    'uin' => '',
                    'paymentPurpose' => 'testPurpose',
                    'creatorStatus' => '',
                    'payerKpp' => '987654321',
                    'recipientKpp' => '770000000',
                    'kbk' => '18210202103081013160',
                    'oktmo' => '78701000',
                    'taxEvidence' => 'ГД',
                    'taxPeriod' => '2019',
                    'taxDocNumber' => '15',
                    'taxDocDate' => date('Y-m-d'),
                    'taxType' => 'НС',
                    'executionOrder' => '5'
                ]
            ]
        ];
    }
}
