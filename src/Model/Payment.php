<?php

namespace Tinkoff\Business\Model;

use DateTime;

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
     * @var DateTime $date
     */
    private $date;

    /**
     * Сумма платежа
     * @var float $amount
     */
    private $amount;

    /**
     * Получатель
     * @var Company $recipien
     */
    private $recipient;

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
     * Показатель налогового платежа
     * @var Tax $tax
     */
    private $tax;

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
     * Код УИН
     * @var string $uin
     */
    private $uin;

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
    public function setDocumentNumber(?string $documentNumber): void
    {
        $this->documentNumber = $documentNumber;
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
     * @return int
     */
    public function getExecutionOrder(): ?int
    {
        return $this->executionOrder;
    }

    /**
     * @param int $executionOrder
     */
    public function setExecutionOrder(?int $executionOrder): void
    {
        $this->executionOrder = $executionOrder;
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
}
