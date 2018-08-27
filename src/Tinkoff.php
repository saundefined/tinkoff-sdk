<?php

namespace Tinkoff\Business;

use GuzzleHttp\Client;
use Tinkoff\Business\Exception\ApiException;
use Tinkoff\Business\Exception\ArgumentException;
use Tinkoff\Business\Exception\HttpException;
use Tinkoff\Business\Exception\NotFoundException;
use Tinkoff\Business\Model\Account;
use Tinkoff\Business\Model\AccountCollection;
use Tinkoff\Business\Model\Balance;
use Tinkoff\Business\Model\Operation;
use Tinkoff\Business\Model\OperationCollection;
use Tinkoff\Business\Model\Payment;

class Tinkoff
{
    private const HTTP_GET = 'GET';
    private const HTTP_POST = 'POST';

    private $inn;
    private $access_token;

    public function __construct($inn)
    {
        $this->inn = $inn;
    }

    /**
     * Получение списка счетов
     *
     * @return AccountCollection
     *
     * @throws ApiException
     * @throws ArgumentException
     * @throws HttpException
     */
    public function getAccounts(): AccountCollection
    {
        $result = $this->query('accounts');

        $accountCollection = new AccountCollection();
        foreach ($result as $item) {
            $account = new Account();
            if ($item['accountNumber']) {
                $account->setAccountNumber($item['accountNumber']);
            }
            if ($item['status']) {
                $account->setStatus($item['status']);
            }
            if ($item['name']) {
                $account->setName($item['name']);
            }
            if ($item['currency']) {
                $account->setCurrency($item['currency']);
            }

            $balance = new Balance();
            if ($item['balance']['otb']) {
                $balance->setOtb($item['balance']['otb']);
            }
            if ($item['balance']['authorized']) {
                $balance->setAuthorized($item['balance']['authorized']);
            }
            if ($item['balance']['pendingPayments']) {
                $balance->setPendingPayments($item['balance']['pendingPayments']);
            }
            if ($item['balance']['pendingRequisitions']) {
                $balance->setPendingRequisitions($item['balance']['pendingRequisitions']);
            }

            $account->setBalance($balance);

            $accountCollection->add($account);
        }

        return $accountCollection;
    }

    /**
     * Запрос к API
     *
     * @param string $command
     * @param array $options
     * @param string $method
     *
     * @return array
     * @throws ArgumentException
     * @throws HttpException
     * @throws ApiException
     */
    private function query($command, array $options = [], $method = self::HTTP_GET): array
    {
        if (!$this->inn || !$this->access_token) {
            throw new ArgumentException('Parameters inn and access_token are required');
        }

        $client = new Client([
            'base_uri' => 'https://sme-partner.tinkoff.ru/api/v1/partner/company/' . $this->inn . '/'
        ]);

        $data = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
                'Content-Type' => 'application/json'
            ]
        ];

        if ($method === self::HTTP_GET) {
            $data['query'] = $options;
            $response = $client->get($command, $data);
        } else {
            $data['body'] = json_encode($options);
            $response = $client->post($command, $data);
        }

        $result = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() !== 200) {
            throw new HttpException('Api response status code is not 200');
        }

        if ($result['errorCode'] && $result['errorMessage']) {
            throw new ApiException('[' . $result['errorCode'] . '] ' . $result['errorMessage']);
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @param string $access_token
     */
    public function setAccessToken($access_token): void
    {
        $this->access_token = $access_token;
    }

    /**
     * Получение выписки
     *
     * @param string $accountNumber Номер расчетного счета
     * @param array $options
     * $options[from] \DateTime Дата начала периода (опциональный, если не передан, берем дату конца - 1
     *     месяц).
     * $options[till] \DateTime Дата конца периода (опциональный, если не передан, берем по сегодняшний
     *     день включительно)
     *
     * @return Account
     *
     * @throws ApiException
     * @throws ArgumentException
     * @throws HttpException
     * @throws NotFoundException
     */
    public function getAccount($accountNumber, array $options = []): Account
    {
        if (!$accountNumber) {
            throw new ArgumentException('Parameter accountNumber is required');
        }

        $account = $this->getAccounts()->getByAccountNumber($accountNumber);

        $options['accountNumber'] = $accountNumber;
        if ($options['from'] instanceof \DateTime) {
            $options['from'] = $options['from']->format('Y-m-d\+H:i:s');
        } else {
            unset($options['from']);
        }
        if ($options['till'] instanceof \DateTime) {
            $options['till'] = $options['till']->format('Y-m-d\+H:i:s');
        } else {
            unset($options['till']);
        }

        $result = $this->query('excerpt', $options);

        if ($result['saldoIn']) {
            $account->setSaldoIn($result['saldoIn']);
        }

        if ($result['saldoOut']) {
            $account->setSaldoOut($result['saldoOut']);
        }
        if ($result['income']) {
            $account->setIncome($result['income']);
        }
        if ($result['outcome']) {
            $account->setOutcome($result['outcome']);
        }

        $operationCollection = new OperationCollection();
        foreach ($result['operation'] as $item) {
            $operation = new Operation();

            if ($item['id']) {
                $operation->setId($item['id']);
            }
            if ($item['date']) {
                $operation->setDate(new \DateTime($item['date']));
            }
            if ($item['amount']) {
                $operation->setAmount($item['amount']);
            }
            if ($item['drawDate']) {
                $operation->setDrawDate(new \DateTime($item['drawDate']));
            }
            if ($item['payerName']) {
                $operation->setPayerName($item['payerName']);
            }
            if ($item['payerInn']) {
                $operation->setPayerInn($item['payerInn']);
            }
            if ($item['payerKpp']) {
                $operation->setPayerKpp($item['payerKpp']);
            }
            if ($item['payerAccount']) {
                $operation->setPayerAccount($item['payerAccount']);
            }
            if ($item['payerCorrAccount']) {
                $operation->setPayerCorrAccount($item['payerCorrAccount']);
            }
            if ($item['payerBic']) {
                $operation->setPayerBic($item['payerBic']);
            }
            if ($item['payerBank']) {
                $operation->setPayerBank($item['payerBank']);
            }
            if ($item['chargeDate']) {
                $operation->setChargeDate(new \DateTime($item['chargeDate']));
            }
            if ($item['recipient']) {
                $operation->setRecipient($item['recipient']);
            }
            if ($item['recipientInn']) {
                $operation->setRecipientInn($item['recipientInn']);
            }
            if ($item['recipientKpp']) {
                $operation->setRecipientKpp($item['recipientKpp']);
            }
            if ($item['recipientAccount']) {
                $operation->setRecipientAccount($item['recipientAccount']);
            }
            if ($item['recipientCorrAccount']) {
                $operation->setRecipientCorrAccount($item['recipientCorrAccount']);
            }
            if ($item['recipientBic']) {
                $operation->setRecipientBic($item['recipientBic']);
            }
            if ($item['recipientBank']) {
                $operation->setRecipientBank($item['recipientBank']);
            }
            if ($item['operationType']) {
                $operation->setOperationType($item['operationType']);
            }
            if ($item['uin']) {
                $operation->setUin($item['uin']);
            }
            if ($item['paymentPurpose']) {
                $operation->setPaymentPurpose($item['paymentPurpose']);
            }
            if ($item['creatorStatus']) {
                $operation->setCreatorStatus($item['creatorStatus']);
            }
            if ($item['kbk']) {
                $operation->setKbk($item['kbk']);
            }
            if ($item['oktmo']) {
                $operation->setOktmo($item['oktmo']);
            }
            if ($item['taxEvidence']) {
                $operation->setTaxEvidence($item['taxEvidence']);
            }
            if ($item['taxPeriod']) {
                $operation->setTaxPeriod($item['taxPeriod']);
            }
            if ($item['taxDocNumber']) {
                $operation->setTaxDocNumber($item['taxDocNumber']);
            }
            if ($item['taxDocDate']) {
                $operation->setTaxDocDate(new \DateTime($item['taxDocDate']));
            }
            if ($item['taxType']) {
                $operation->setTaxType($item['taxType']);
            }
            if ($item['executionOrder']) {
                $operation->setExecutionOrder($item['executionOrder']);
            }

            $operationCollection->add($operation);
        }

        $account->setOperations($operationCollection);

        return $account;
    }

    /**
     * Отправка платежного поручения
     *
     * @param Payment $payment
     *
     * @return int Идентификатор платежного поручения
     *
     * @throws ApiException
     * @throws ArgumentException
     * @throws HttpException
     */
    public function sendPayment(Payment $payment)
    {
        $options = [
            'kpp' => '0',
            'kbk' => '0',
            'oktmo' => '0',
            'taxPayerStatus' => '0',
            'taxEvidence' => '0',
            'taxPeriod' => '0',
            'uin' => '0',
            'taxDocNumber' => '0',
            'taxDocDate' => '0'
        ];

        if ($payment->getDocumentNumber() !== null) {
            $options['documentNumber'] = $payment->getDocumentNumber();
        }
        if ($payment->getDate() instanceof \DateTime) {
            $options['date'] = $payment->getDate()->format('c');
        }
        if ($payment->getAmount() !== null) {
            $options['amount'] = $payment->getAmount();
        }
        if ($payment->getRecipientName() !== null) {
            $options['recipientName'] = $payment->getRecipientName();
        }
        if ($payment->getInn() !== null) {
            $options['inn'] = $payment->getInn();
        }
        if ($payment->getKpp() !== null) {
            $options['kpp'] = $payment->getKpp();
        }
        if ($payment->getBankAcnt() !== null) {
            $options['bankAcnt'] = $payment->getBankAcnt();
        }
        if ($payment->getBankBik() !== null) {
            $options['bankBik'] = $payment->getBankBik();
        }
        if ($payment->getAccountNumber() !== null) {
            $options['accountNumber'] = $payment->getAccountNumber();
        }
        if ($payment->getPaymentPurpose() !== null) {
            $options['paymentPurpose'] = $payment->getPaymentPurpose();
        }
        if ($payment->getExecutionOrder() !== null) {
            $options['executionOrder'] = $payment->getExecutionOrder();
        }
        if ($payment->getTaxPayerStatus() !== null) {
            $options['taxPayerStatus'] = $payment->getTaxPayerStatus();
        }
        if ($payment->getKbk() !== null) {
            $options['kbk'] = $payment->getKbk();
        }
        if ($payment->getOktmo()) {
            $options['oktmo'] = $payment->getOktmo();
        }
        if ($payment->getTaxEvidence() !== null) {
            $options['taxEvidence'] = $payment->getTaxEvidence();
        }
        if ($payment->getTaxPeriod() !== null) {
            $options['taxPeriod'] = $payment->getTaxPeriod();
        }
        if ($payment->getUin() !== null) {
            $options['uin'] = $payment->getUin();
        }
        if ($payment->getTaxDocNumber() !== null) {
            $options['taxDocNumber'] = $payment->getTaxDocNumber();
        }
        if ($payment->getTaxDocDate() instanceof \DateTime) {
            $options['taxDocDate'] = $payment->getTaxDocDate()->format('d.m.Y');
        }

        $result = $this->query('payment', $options, self::HTTP_POST);

        return $result['documentId'];
    }

    /**
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }
}