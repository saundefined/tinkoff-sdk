<?php

namespace Tinkoff\Business\Model;

use DateTime;

class Operation
{
    /**
     * Номер документа
     * @var string $id
     */
    private $id;

    /**
     * Дата документа
     * @var DateTime $date
     */
    private $date;

    /**
     * Сумма платежа
     * @var float $amount
     */
    private $amount;

    /**
     * Плательщик
     * @var Company $payer
     */
    private $payer;

    /**
     * Дата списания средств с р/с
     * @var DateTime $drawDate
     */
    private $drawDate;

    /**
     * Дата поступления средств на р/с
     * @var DateTime $chargeDate
     */
    private $chargeDate;

    /**
     * Получатель
     * @var Company $recipient
     */
    private $recipient;

    /**
     * Вид платежа
     * @var string $paymentType
     */
    private $paymentType;

    /**
     * Вид оплаты (вид операции)
     * @var string $operationType
     */
    private $operationType;

    /**
     * Уникальный идентификатор платежа
     * @var string $uin
     */
    private $uin;

    /**
     * Назначение платежа
     * @var string $paymentPurpose
     */
    private $paymentPurpose;

    /**
     * Статус составителя расчетного документа
     * @var string $creatorStatus
     */
    private $creatorStatus;

    /**
     * Показатель кода бюджетной классификации
     * @var string $kbk
     */
    private $kbk;

    /**
     * Код ОКТМО территории, на которой мобилизуются денежные средства от уплаты налога, сбора и иного платежа
     * @var string $oktmo
     */
    private $oktmo;

    /**
     * Показатель налогового платежа
     * @var Tax $tax
     */
    private $tax;

    /**
     * Очередность платежа
     * @var string $executionOrder
     */
    private $executionOrder;

    public static function createFromArray($data): Operation
    {
        unset($data['drawDate']);

        $model = new self();
        $model->setId($data['id']);
        $model->setDate(new DateTime($data['date']));
        $model->setAmount($data['amount']);
        $model->setDrawDate(new DateTime($data['drawDate']));

        $payer = new Company();
        $payer->setName($data['payerName']);
        $payer->setInn($data['payerInn']);
        $payer->setKpp($data['payerKpp']);

        $payerBank = new Bank();
        $payerBank->setAccountNumber($data['payerAccount']);
        $payerBank->setCorrAccount($data['payerCorrAccount']);
        $payerBank->setBic($data['payerBic']);
        $payerBank->setName($data['payerBank']);
        $payer->setBank($payerBank);
        $model->setPayer($payer);

        $recipient = new Company();
        $recipient->setName($data['recipient']);
        $recipient->setInn($data['recipientInn']);
        $recipient->setKpp($data['recipientKpp']);

        $recipientBank = new Bank();
        $recipientBank->setAccountNumber($data['recipientAccount']);
        $recipientBank->setCorrAccount($data['recipientCorrAccount']);
        $recipientBank->setBic($data['recipientBic']);
        $recipientBank->setName($data['recipientBank']);
        $recipient->setBank($recipientBank);
        $model->setRecipient($recipient);

        $model->setChargeDate(new DateTime($data['chargeDate']));
        $model->setPaymentType($data['paymentType']);
        $model->setOperationType($data['operationType']);
        $model->setUin($data['uin']);
        $model->setPaymentPurpose($data['paymentPurpose']);
        $model->setCreatorStatus($data['creatorStatus']);
        $model->setExecutionOrder($data['executionOrder']);

        $model->setKbk($data['kbk']);
        $model->setOktmo($data['oktmo']);

        $tax = new Tax();
        $tax->setEvidence($data['taxEvidence']);
        $tax->setPeriod($data['taxPeriod']);
        $tax->setNumber($data['taxDocNumber']);
        $tax->setDate(new DateTime($data['taxDocDate']));
        $tax->setType($data['taxType']);
        $model->setTax($tax);

        return $model;
    }

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(?DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return float
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(?float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return Company
     */
    public function getPayer(): ?Company
    {
        return $this->payer;
    }

    /**
     * @param Company $payer
     */
    public function setPayer(?Company $payer): void
    {
        $this->payer = $payer;
    }

    /**
     * @return DateTime
     */
    public function getDrawDate(): ?DateTime
    {
        return $this->drawDate;
    }

    /**
     * @param DateTime $drawDate
     */
    public function setDrawDate(?DateTime $drawDate): void
    {
        $this->drawDate = $drawDate;
    }

    /**
     * @return Company
     */
    public function getRecipient(): ?Company
    {
        return $this->recipient;
    }

    /**
     * @param Company $recipient
     */
    public function setRecipient(?Company $recipient): void
    {
        $this->recipient = $recipient;
    }

    /**
     * @return DateTime
     */
    public function getChargeDate(): ?DateTime
    {
        return $this->chargeDate;
    }

    /**
     * @param DateTime $chargeDate
     */
    public function setChargeDate(?DateTime $chargeDate): void
    {
        $this->chargeDate = $chargeDate;
    }

    /**
     * @return string
     */
    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }

    /**
     * @param string $paymentType
     */
    public function setPaymentType(?string $paymentType): void
    {
        $this->paymentType = $paymentType;
    }

    /**
     * @return string
     */
    public function getOperationType(): ?string
    {
        return $this->operationType;
    }

    /**
     * @param string $operationType
     */
    public function setOperationType(?string $operationType): void
    {
        $this->operationType = $operationType;
    }

    /**
     * @return string
     */
    public function getUin(): ?string
    {
        return $this->uin;
    }

    /**
     * @param string $uin
     */
    public function setUin(?string $uin): void
    {
        $this->uin = $uin;
    }

    /**
     * @return string
     */
    public function getPaymentPurpose(): ?string
    {
        return $this->paymentPurpose;
    }

    /**
     * @param string $paymentPurpose
     */
    public function setPaymentPurpose(?string $paymentPurpose): void
    {
        $this->paymentPurpose = $paymentPurpose;
    }

    /**
     * @return string
     */
    public function getCreatorStatus(): ?string
    {
        return $this->creatorStatus;
    }

    /**
     * @param string $creatorStatus
     */
    public function setCreatorStatus(?string $creatorStatus): void
    {
        $this->creatorStatus = $creatorStatus;
    }

    /**
     * @return string
     */
    public function getKbk(): ?string
    {
        return $this->kbk;
    }

    /**
     * @param string $kbk
     */
    public function setKbk(?string $kbk): void
    {
        $this->kbk = $kbk;
    }

    /**
     * @return string
     */
    public function getOktmo(): ?string
    {
        return $this->oktmo;
    }

    /**
     * @param string $oktmo
     */
    public function setOktmo(?string $oktmo): void
    {
        $this->oktmo = $oktmo;
    }

    /**
     * @return Tax
     */
    public function getTax(): ?Tax
    {
        return $this->tax;
    }

    /**
     * @param Tax $tax
     */
    public function setTax(?Tax $tax): void
    {
        $this->tax = $tax;
    }

    /**
     * @return string
     */
    public function getExecutionOrder(): ?string
    {
        return $this->executionOrder;
    }

    /**
     * @param string $executionOrder
     */
    public function setExecutionOrder(?string $executionOrder): void
    {
        $this->executionOrder = $executionOrder;
    }
}
