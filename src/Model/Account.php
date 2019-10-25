<?php

namespace Tinkoff\Business\Model;

class Account
{
    /**
     * Номер счета
     * @var string $accountNumber
     */
    private $accountNumber;

    /**
     * Статус счета
     * @var string $status
     */
    private $status;

    /**
     * Название счета
     * @var string $name
     */
    private $name;

    /**
     * Валюта счета
     * @var int $name
     */
    private $currency;

    /**
     * Баланс счета
     * @var Balance $balance
     */
    private $balance;

    public static function createFromArray($data): ?Account
    {
        $model = new self();
        if (!empty($data['accountNumber'])) {
            $model->setAccountNumber($data['accountNumber']);
        }
        if (!empty($data['status'])) {
            $model->setStatus($data['status']);
        }
        if (!empty($data['name'])) {
            $model->setName($data['name']);
        }
        if (!empty($data['currency'])) {
            $model->setCurrency($data['currency']);
        }

        $balance = new Balance();
        if (!empty($data['balance']['otb'])) {
            $balance->setOtb($data['balance']['otb']);
        }
        if (!empty($data['balance']['authorized'])) {
            $balance->setAuthorized($data['balance']['authorized']);
        }
        if (!empty($data['balance']['pendingPayments'])) {
            $balance->setPendingPayments($data['balance']['pendingPayments']);
        }
        if (!empty($data['balance']['pendingRequisitions'])) {
            $balance->setPendingRequisitions($data['balance']['pendingRequisitions']);
        }

        $model->setBalance($balance);

        return $model;
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
    public function setAccountNumber(?string $accountNumber): void
    {
        $this->accountNumber = $accountNumber;
    }

    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getCurrency(): ?int
    {
        return $this->currency;
    }

    /**
     * @param int $currency
     */
    public function setCurrency(?int $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return Balance
     */
    public function getBalance(): ?Balance
    {
        return $this->balance;
    }

    /**
     * @param Balance $balance
     */
    public function setBalance(?Balance $balance): void
    {
        $this->balance = $balance;
    }
}
