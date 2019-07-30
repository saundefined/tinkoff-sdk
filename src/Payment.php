<?php

namespace Tinkoff\Business;

use Tinkoff\Business\Model\Response;

class Payment
{
    private $client;

    private $payment;

    public function __construct(Client $client, Model\Payment $payment)
    {
        $this->client = $client;

        $this->payment = $payment;
    }

    public function send()
    {
        $parameters = [
            'documentNumber' => $this->payment->getDocumentNumber(),
            'date' => $this->payment->getDate() ? $this->payment->getDate()->format('Y-m-d') : null,
            'amount' => $this->payment->getAmount(),
            'paymentPurpose' => $this->payment->getPaymentPurpose(),
            'executionOrder' => $this->payment->getExecutionOrder(),
            'kbk' => $this->payment->getKbk(),
            'oktmo' => $this->payment->getOktmo(),
            'uin' => $this->payment->getUin(),
        ];

        if ($recipient = $this->payment->getRecipient()) {
            $parameters = array_merge($parameters, [
                'recipientName' => $recipient->getName(),
                'inn' => $recipient->getInn(),
                'kpp' => $recipient->getKpp(),
            ]);

            if ($bank = $recipient->getBank()) {
                $parameters = array_merge($parameters, [
                    'bankAcnt' => $bank->getAccountNumber(),
                    'bankBik' => $bank->getBic(),
                    'accountNumber' => $bank->getAccountNumber(),
                ]);
            }
        }

        if ($tax = $this->payment->getTax()) {
            $parameters = array_merge($parameters, [
                'taxEvidence' => $tax->getEvidence(),
                'taxPeriod' => $tax->getPeriod(),
                'taxDocNumber' => $tax->getNumber(),
                'taxDocDate' => $tax->getDate(),
                'taxPayerStatus' => $tax->getPayerStatus(),
            ]);
        }

        $data = $this->client->query('payment', $parameters, 'POST');

        $response = new Response();
        $response->setRequestId($data['requestId']);
        $response->setResult($data['result']);

        return $response;
    }
}
