<?php

namespace Tinkoff\Business;

use Tinkoff\Business\Model\Document;

class Payment
{
    private $client;

    private $account;

    private $payment;

    /**
     * Payment constructor.
     *
     * @param Client $client
     *
     * @param Model\Account $account Счет с которого происходит оплата
     * @param Model\Payment $payment
     */
    public function __construct(Client $client, Model\Account $account, Model\Payment $payment)
    {
        $this->client = $client;

        $this->account = $account;

        $this->payment = $payment;
    }

    public function send(): Document
    {
        $parameters = [
            'documentNumber' => $this->payment->getDocumentNumber() ?? '',
            'date' => $this->payment->getDate() ? $this->payment->getDate()->format('c') : (new \DateTime())->format('c'),
            'amount' => $this->payment->getAmount(),
            'paymentPurpose' => $this->payment->getPaymentPurpose() ?? '',
            'executionOrder' => $this->payment->getExecutionOrder(),
            'kbk' => $this->payment->getKbk() ?? '',
            'oktmo' => $this->payment->getOktmo() ?? '',
            'uin' => $this->payment->getUin() ?? '',
            'accountNumber' => $this->account->getAccountNumber(),
            'recipientName' => $this->payment->getRecipient() && $this->payment->getRecipient()->getName() ?
                $this->payment->getRecipient()->getName() : '',
            'inn' => $this->payment->getRecipient() && $this->payment->getRecipient()->getInn() ?
                $this->payment->getRecipient()->getInn() : '',
            'kpp' => $this->payment->getRecipient() && $this->payment->getRecipient()->getKpp() ?
                $this->payment->getRecipient()->getKpp() : '',
            'bankBik' => $this->payment->getRecipient()->getBank() && $this->payment->getRecipient()->getBank()->getBic() ?
                $this->payment->getRecipient()->getBank()->getBic() : '',
            'bankAcnt' => $this->payment->getRecipient()->getBank() && $this->payment->getRecipient()->getBank()->getAccountNumber() ?
                $this->payment->getRecipient()->getBank()->getAccountNumber() : '',
            'taxEvidence' => $this->payment->getTax() && $this->payment->getTax()->getEvidence() ?
                $this->payment->getTax()->getEvidence() : '',
            'taxPeriod' => $this->payment->getTax() && $this->payment->getTax()->getPeriod() ?
                $this->payment->getTax()->getPeriod() : '',
            'taxDocNumber' => $this->payment->getTax() && $this->payment->getTax()->getNumber() ?
                $this->payment->getTax()->getNumber() : '',
            'taxDocDate' => $this->payment->getTax() && $this->payment->getTax()->getDate() ?
                $this->payment->getTax()->getDate()->format('c') : (new \DateTime())->format('c'),
            'taxPayerStatus' => $this->payment->getTax() && $this->payment->getTax()->getPayerStatus() ?
                $this->payment->getTax()->getPayerStatus() : '',
        ];

        $data = $this->client->query('payment', $parameters, 'POST');

        $response = new Document();
        $response->setId($data['documentId']);

        return $response;
    }
}
