<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Tinkoff\Business\Model\Account;
use Tinkoff\Business\Model\Bank;
use Tinkoff\Business\Model\Company;
use Tinkoff\Business\Model\Payment;
use Tinkoff\Business\Model\Tax;

final class PaymentTest extends TestCase
{
    private $payment = [];

    public function testShouldReturnSuccessResponse(): void
    {
        $client = $this->createClient([
            'documentId' => 'ea0b025e-147a-47c8-90db-c31e355ffce7'
        ]);

        $account = new Account();
        $account->setAccountNumber('40101810900000000974');

        $response = $client->payment($account, $this->payment)->send();

        $this->assertSame('ea0b025e-147a-47c8-90db-c31e355ffce7', $response->getId());
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

    protected function setUp(): void
    {
        $this->payment = new Payment();
        $this->payment->setDocumentNumber('1');
        $this->payment->setDate(new DateTime());
        $this->payment->setAmount(100.0);

        $recipient = new Company();
        $recipient->setName('ООО Ромашка');
        $recipient->setInn('760000000000');
        $recipient->setKpp('770000000');

        $bank = new Bank();
        $bank->setAccountNumber('40101810900000000974');
        $bank->setName('АО "ТИНЬКОФФ БАНК"');
        $bank->setBic('044525974');
        $bank->setCorrAccount('');
        $recipient->setBank($bank);

        $this->payment->setRecipient($recipient);
        $this->payment->setPaymentPurpose('Тестовый платеж');
        $this->payment->setExecutionOrder(5);

        $tax = new Tax();
        $tax->setPayerStatus('Что то');
        $tax->setEvidence('ГД');
        $tax->setPeriod('2019');
        $tax->setNumber('15');
        $tax->setDate(new DateTime());
        $this->payment->setTax($tax);

        $this->payment->setKbk('18210202103081013160');
        $this->payment->setOktmo('78701000');
        $this->payment->setUin('78701000');
    }
}
