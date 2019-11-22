<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tinkoff\Business\Model\Operation;

final class OperationModelTest extends TestCase
{
    public function testShouldReturnOperationFromArray(): void
    {
        $data = [
            'id' => '3000000001',
            'date' => date('Y-m-d'),
            'amount' => 25000,
            'drawDate' => date('Y-m-d'),
            'payerName' => 'Payer',
            'payerInn' => '1111111111',
            'payerAccount' => '40101810900000000974',
            'payerCorrAccount' => null,
            'payerBic' => '987654320',
            'payerBank' => 'АО "ТИНЬКОФФ БАНК"',
            'chargeDate' => date('Y-m-d'),
            'recipient' => 'Receiver',
            'recipientInn' => '2222222222',
            'recipientAccount' => '40101810900000000974',
            'recipientCorrAccount' => null,
            'recipientBic' => '044525974',
            'recipientBank' => 'АО "ТИНЬКОФФ БАНК"',
            'paymentType' => 'Оплата контрагенту',
            'operationType' => '17',
            'uin' => null,
            'paymentPurpose' => 'testPurpose',
            'creatorStatus' => null,
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
        ];

        $operation = Operation::createFromArray($data);

        $this->assertSame($data['id'], $operation->getId());
        $this->assertSame($data['date'], $operation->getDate()->format('Y-m-d'));
        $this->assertEquals($data['amount'], $operation->getAmount());
        $this->assertEquals($data['drawDate'], $operation->getDrawDate()->format('Y-m-d'));

        $payer = $operation->getPayer();
        $this->assertSame($data['payerName'], $payer->getName());
        $this->assertSame($data['payerInn'], $payer->getInn());
        $this->assertSame($data['payerKpp'], $payer->getKpp());

        $payerBank = $payer->getBank();
        $this->assertSame($data['payerAccount'], $payerBank->getAccountNumber());
        $this->assertSame($data['payerCorrAccount'], $payerBank->getCorrAccount());
        $this->assertSame($data['payerBic'], $payerBank->getBic());
        $this->assertSame($data['payerBank'], $payerBank->getName());

        $this->assertSame($data['chargeDate'], $operation->getChargeDate()->format('Y-m-d'));

        $recipient = $operation->getRecipient();
        $this->assertSame($data['recipient'], $recipient->getName());
        $this->assertSame($data['recipientInn'], $recipient->getInn());
        $this->assertSame($data['recipientKpp'], $recipient->getKpp());

        $recipientBank = $recipient->getBank();
        $this->assertSame($data['recipientAccount'], $recipientBank->getAccountNumber());
        $this->assertSame($data['recipientCorrAccount'], $recipientBank->getCorrAccount());
        $this->assertSame($data['recipientBic'], $recipientBank->getBic());
        $this->assertSame($data['recipientBank'], $recipientBank->getName());

        $this->assertSame($data['paymentType'], $operation->getPaymentType());
        $this->assertSame($data['operationType'], $operation->getOperationType());
        $this->assertSame($data['uin'], $operation->getUin());
        $this->assertSame($data['paymentPurpose'], $operation->getPaymentPurpose());
        $this->assertSame($data['creatorStatus'], $operation->getCreatorStatus());
        $this->assertSame($data['creatorStatus'], $operation->getCreatorStatus());

        $this->assertSame($data['kbk'], $operation->getKbk());
        $this->assertSame($data['oktmo'], $operation->getOktmo());

        $tax = $operation->getTax();
        $this->assertSame($data['taxEvidence'], $tax->getEvidence());
        $this->assertSame($data['taxPeriod'], $tax->getPeriod());
        $this->assertSame($data['taxDocNumber'], $tax->getNumber());
        $this->assertSame($data['taxDocDate'], $tax->getDate()->format('Y-m-d'));
        $this->assertSame($data['taxType'], $tax->getType());

        $this->assertSame($data['executionOrder'], $operation->getExecutionOrder());
    }

}
