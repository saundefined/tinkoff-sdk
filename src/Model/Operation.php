<?php

namespace Tinkoff\Business\Model;

use Tinkoff\Business\Base\BaseModel;

/**
 * Class Operation
 * @package Tinkoff\Business\Model
 */
class Operation extends BaseModel
{
    /**
     * Номер документа
     * @var int $id
     */
    private $id;

    /**
     * Дата документа
     * @var \DateTime $date
     */
    private $date;

    /**
     * Сумма платежа
     * @var float $amount
     */
    private $amount;

    /**
     * Расчетный счет плательщика
     * @var string $payerAccount
     */
    private $payerAccount;

    /**
     * Дата списания средств с р/с
     * @var \DateTime $drawDate
     */
    private $drawDate;

    /**
     * Плательщик
     * @var string $payerName
     */
    private $payerName;

    /**
     * ИНН плательщика
     * @var string $payerInn
     */
    private $payerInn;

    /**
     * Кор. счет банка плательщика
     * @var string $payerCorrAccount
     */
    private $payerCorrAccount;

    /**
     * Бик банка плательщика
     * @var string $payerBic
     */
    private $payerBic;

    /**
     * Название банка плательщика
     * @var string $payerBank
     */
    private $payerBank;

    /**
     * Расчетный счет получателя
     * @var string $recipientAccount
     */
    private $recipientAccount;

    /**
     * Дата поступления средств на р/с
     * @var \DateTime $chargeDate
     */
    private $chargeDate;

    /**
     * Получатель
     * @var string $recipient
     */
    private $recipient;

    /**
     * ИНН получателя
     * @var string $recipientInn
     */
    private $recipientInn;

    /**
     * Расчетный счет получателя
     * @var string $recipientCorrAccount
     */
    private $recipientCorrAccount;

    /**
     * Бик банка получателя
     * @var string $recipientBic
     */
    private $recipientBic;

    /**
     * Название банка получателя
     * @var string $recipientBank
     */
    private $recipientBank;

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
     * КПП плательщика
     * @var string $recipientKpp
     */
    private $recipientKpp;

    /**
     * КПП получателя
     * @var string $payerKpp
     */
    private $payerKpp;

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
     * Показатель основания налогового платежа
     * @var string $taxEvidence
     */
    private $taxEvidence;

    /**
     * Показатель налогового периода / Код таможенного органа
     * @var string $taxPeriod
     */
    private $taxPeriod;

    /**
     * Показатель номера документа
     * @var string $taxDocNumber
     */
    private $taxDocNumber;

    /**
     * Показатель даты документа
     * @var \DateTime $taxDocDate
     */
    private $taxDocDate;

    /**
     * Показатель типа платежа
     * @var string $taxType
     */
    private $taxType;

    /**
     * Очередность платежа
     * @var string $executionOrder
     */
    private $executionOrder;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
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
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getPayerAccount(): ?string
    {
        return $this->payerAccount;
    }

    /**
     * @param string $payerAccount
     */
    public function setPayerAccount(string $payerAccount): void
    {
        $this->payerAccount = $payerAccount;
    }

    /**
     * @return \DateTime
     */
    public function getDrawDate(): ?\DateTime
    {
        return $this->drawDate;
    }

    /**
     * @param \DateTime $drawDate
     */
    public function setDrawDate(\DateTime $drawDate): void
    {
        $this->drawDate = $drawDate;
    }

    /**
     * @return string
     */
    public function getPayerName(): ?string
    {
        return $this->payerName;
    }

    /**
     * @param string $payerName
     */
    public function setPayerName(string $payerName): void
    {
        $this->payerName = $payerName;
    }

    /**
     * @return string
     */
    public function getPayerInn(): ?string
    {
        return $this->payerInn;
    }

    /**
     * @param string $payerInn
     */
    public function setPayerInn(string $payerInn): void
    {
        $this->payerInn = $payerInn;
    }

    /**
     * @return string
     */
    public function getPayerCorrAccount(): ?string
    {
        return $this->payerCorrAccount;
    }

    /**
     * @param string $payerCorrAccount
     */
    public function setPayerCorrAccount(string $payerCorrAccount): void
    {
        $this->payerCorrAccount = $payerCorrAccount;
    }

    /**
     * @return string
     */
    public function getPayerBic(): ?string
    {
        return $this->payerBic;
    }

    /**
     * @param string $payerBic
     */
    public function setPayerBic(string $payerBic): void
    {
        $this->payerBic = $payerBic;
    }

    /**
     * @return string
     */
    public function getPayerBank(): ?string
    {
        return $this->payerBank;
    }

    /**
     * @param string $payerBank
     */
    public function setPayerBank(string $payerBank): void
    {
        $this->payerBank = $payerBank;
    }

    /**
     * @return string
     */
    public function getRecipientAccount(): ?string
    {
        return $this->recipientAccount;
    }

    /**
     * @param string $recipientAccount
     */
    public function setRecipientAccount(string $recipientAccount): void
    {
        $this->recipientAccount = $recipientAccount;
    }

    /**
     * @return \DateTime
     */
    public function getChargeDate(): ?\DateTime
    {
        return $this->chargeDate;
    }

    /**
     * @param \DateTime $chargeDate
     */
    public function setChargeDate(\DateTime $chargeDate): void
    {
        $this->chargeDate = $chargeDate;
    }

    /**
     * @return string
     */
    public function getRecipient(): ?string
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     */
    public function setRecipient(string $recipient): void
    {
        $this->recipient = $recipient;
    }

    /**
     * @return string
     */
    public function getRecipientInn(): ?string
    {
        return $this->recipientInn;
    }

    /**
     * @param string $recipientInn
     */
    public function setRecipientInn(string $recipientInn): void
    {
        $this->recipientInn = $recipientInn;
    }

    /**
     * @return string
     */
    public function getRecipientCorrAccount(): ?string
    {
        return $this->recipientCorrAccount;
    }

    /**
     * @param string $recipientCorrAccount
     */
    public function setRecipientCorrAccount(string $recipientCorrAccount): void
    {
        $this->recipientCorrAccount = $recipientCorrAccount;
    }

    /**
     * @return string
     */
    public function getRecipientBic(): ?string
    {
        return $this->recipientBic;
    }

    /**
     * @param string $recipientBic
     */
    public function setRecipientBic(string $recipientBic): void
    {
        $this->recipientBic = $recipientBic;
    }

    /**
     * @return string
     */
    public function getRecipientBank(): ?string
    {
        return $this->recipientBank;
    }

    /**
     * @param string $recipientBank
     */
    public function setRecipientBank(string $recipientBank): void
    {
        $this->recipientBank = $recipientBank;
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
    public function setPaymentType(string $paymentType): void
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
    public function setOperationType(string $operationType): void
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
    public function setUin(string $uin): void
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
    public function setPaymentPurpose(string $paymentPurpose): void
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
    public function setCreatorStatus(string $creatorStatus): void
    {
        $this->creatorStatus = $creatorStatus;
    }

    /**
     * @return string
     */
    public function getRecipientKpp(): ?string
    {
        return $this->recipientKpp;
    }

    /**
     * @param string $recipientKpp
     */
    public function setRecipientKpp(string $recipientKpp): void
    {
        $this->recipientKpp = $recipientKpp;
    }

    /**
     * @return string
     */
    public function getPayerKpp(): ?string
    {
        return $this->payerKpp;
    }

    /**
     * @param string $payerKpp
     */
    public function setPayerKpp(string $payerKpp): void
    {
        $this->payerKpp = $payerKpp;
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
    public function setKbk(string $kbk): void
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
    public function setOktmo(string $oktmo): void
    {
        $this->oktmo = $oktmo;
    }

    /**
     * @return string
     */
    public function getTaxEvidence(): ?string
    {
        return $this->taxEvidence;
    }

    /**
     * @param string $taxEvidence
     */
    public function setTaxEvidence(string $taxEvidence): void
    {
        $this->taxEvidence = $taxEvidence;
    }

    /**
     * @return string
     */
    public function getTaxPeriod(): ?string
    {
        return $this->taxPeriod;
    }

    /**
     * @param string $taxPeriod
     */
    public function setTaxPeriod(string $taxPeriod): void
    {
        $this->taxPeriod = $taxPeriod;
    }

    /**
     * @return string
     */
    public function getTaxDocNumber(): ?string
    {
        return $this->taxDocNumber;
    }

    /**
     * @param string $taxDocNumber
     */
    public function setTaxDocNumber(string $taxDocNumber): void
    {
        $this->taxDocNumber = $taxDocNumber;
    }

    /**
     * @return \DateTime
     */
    public function getTaxDocDate(): ?\DateTime
    {
        return $this->taxDocDate;
    }

    /**
     * @param \DateTime $taxDocDate
     */
    public function setTaxDocDate(\DateTime $taxDocDate): void
    {
        $this->taxDocDate = $taxDocDate;
    }

    /**
     * @return string
     */
    public function getTaxType(): ?string
    {
        return $this->taxType;
    }

    /**
     * @param string $taxType
     */
    public function setTaxType(string $taxType): void
    {
        $this->taxType = $taxType;
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
    public function setExecutionOrder(string $executionOrder): void
    {
        $this->executionOrder = $executionOrder;
    }
}