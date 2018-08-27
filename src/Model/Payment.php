<?php

namespace Tinkoff\Business\Model;

class Payment
{
    /**
     * Номер распоряжения, определяемый клиентом
     * @var string $documentNumber
     */
    private $documentNumber;

    /**
     * Дата и время исполнения платежа. Может быть в будущем, либо пустая. Если передана пустая дата, подписанный
     * документ будет принят к исполнению немедленно
     * @var \DateTime $date
     */
    private $date;

    /**
     * Сумма платежа
     * @var float $amount
     */
    private $amount;

    /**
     * Наименование получателя
     * @var string $recipientName
     */
    private $recipientName;

    /**
     * ИНН получателя
     * @var string $inn
     */
    private $inn;

    /**
     * КПП получателя
     * @var string $kpp
     */
    private $kpp;

    /**
     * Счет получателя
     * @var string $bankAcnt
     */
    private $bankAcnt;

    /**
     * БИК банка
     * @var string $bankBik
     */
    private $bankBik;

    /**
     * Счет плательщика
     * @var string $accountNumber
     */
    private $accountNumber;

    /**
     * Назначение платежа
     * @var string $paymentPurpose
     */
    private $paymentPurpose;

    /**
     * Очередность платежа
     * @var int $executionOrder
     */
    private $executionOrder;

    /**
     * Поле платежки 101
     * @var string $taxPayerStatus
     */
    private $taxPayerStatus;

    /**
     * Поле платежки 104
     * @var string $kbk
     */
    private $kbk;

    /**
     * Поле платежки 105
     * @var string $oktmo
     */
    private $oktmo;

    /**
     * Поле 106
     * @var string $taxEvidence
     */
    private $taxEvidence;

    /**
     * Поле 107
     * @var string $taxPeriod
     */
    private $taxPeriod;

    /**
     * Код УИН
     * @var string $uin
     */
    private $uin;

    /**
     * Поле платежки 108
     * @var string $taxDocNumber
     */
    private $taxDocNumber;

    /**
     * Поле платежки 109
     * @var \DateTime $taxDocDate
     */
    private $taxDocDate;

    /**
     * @return string
     */
    public function getDocumentNumber(): ?string
    {
        return $this->documentNumber;
    }

    /**
     * @param string $documentNumber
     */
    public function setDocumentNumber(string $documentNumber): void
    {
        $this->documentNumber = $documentNumber;
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
    public function getRecipientName(): ?string
    {
        return $this->recipientName;
    }

    /**
     * @param string $recipientName
     */
    public function setRecipientName(string $recipientName): void
    {
        $this->recipientName = $recipientName;
    }

    /**
     * @return string
     */
    public function getInn(): ?string
    {
        return $this->inn;
    }

    /**
     * @param string $inn
     */
    public function setInn(string $inn): void
    {
        $this->inn = $inn;
    }

    /**
     * @return string
     */
    public function getKpp(): ?string
    {
        return $this->kpp;
    }

    /**
     * @param string $kpp
     */
    public function setKpp(string $kpp): void
    {
        $this->kpp = $kpp;
    }

    /**
     * @return string
     */
    public function getBankAcnt(): ?string
    {
        return $this->bankAcnt;
    }

    /**
     * @param string $bankAcnt
     */
    public function setBankAcnt(string $bankAcnt): void
    {
        $this->bankAcnt = $bankAcnt;
    }

    /**
     * @return string
     */
    public function getBankBik(): ?string
    {
        return $this->bankBik;
    }

    /**
     * @param string $bankBik
     */
    public function setBankBik(string $bankBik): void
    {
        $this->bankBik = $bankBik;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): ?string
    {
        return $this->accountNumber;
    }

    /**
     * @param string $accountNumber
     */
    public function setAccountNumber(string $accountNumber): void
    {
        $this->accountNumber = $accountNumber;
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
     * @return int
     */
    public function getExecutionOrder(): ?int
    {
        return $this->executionOrder;
    }

    /**
     * @param int $executionOrder
     */
    public function setExecutionOrder(int $executionOrder): void
    {
        $this->executionOrder = $executionOrder;
    }

    /**
     * @return string
     */
    public function getTaxPayerStatus(): ?string
    {
        return $this->taxPayerStatus;
    }

    /**
     * @param string $taxPayerStatus
     */
    public function setTaxPayerStatus(string $taxPayerStatus): void
    {
        $this->taxPayerStatus = $taxPayerStatus;
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
}