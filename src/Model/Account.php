<?php

namespace Tinkoff\Business\Model;

use Tinkoff\Business\Base\BaseModel;

class Account extends BaseModel
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

    /**
     * Начальный остаток
     * @var float $saldoIn
     */
    private $saldoIn;

    /**
     * Обороты входящих платежей
     * @var float $income
     */
    private $income;

    /**
     * Обороты исходящих платежей
     * @var float $outcome
     */
    private $outcome;

    /**
     * Конечный остаток
     * @var float $saldoOut
     */
    private $saldoOut;

    /**
     * Операции со счетом
     * @var OperationCollection $operations
     */
    private $operations;

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
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
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
    public function setName(string $name): void
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
    public function setCurrency(int $currency): void
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
    public function setBalance(Balance $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return float
     */
    public function getSaldoIn(): ?float
    {
        return $this->saldoIn;
    }

    /**
     * @param float $saldoIn
     */
    public function setSaldoIn(float $saldoIn): void
    {
        $this->saldoIn = $saldoIn;
    }

    /**
     * @return float
     */
    public function getIncome(): ?float
    {
        return $this->income;
    }

    /**
     * @param float $income
     */
    public function setIncome(float $income): void
    {
        $this->income = $income;
    }

    /**
     * @return float
     */
    public function getOutcome(): ?float
    {
        return $this->outcome;
    }

    /**
     * @param float $outcome
     */
    public function setOutcome(float $outcome): void
    {
        $this->outcome = $outcome;
    }

    /**
     * @return float
     */
    public function getSaldoOut(): ?float
    {
        return $this->saldoOut;
    }

    /**
     * @param float $saldoOut
     */
    public function setSaldoOut(float $saldoOut): void
    {
        $this->saldoOut = $saldoOut;
    }

    /**
     * @return OperationCollection
     */
    public function getOperations(): ?OperationCollection
    {
        return $this->operations;
    }

    /**
     * @param OperationCollection $operations
     */
    public function setOperations(OperationCollection $operations): void
    {
        $this->operations = $operations;
    }

}