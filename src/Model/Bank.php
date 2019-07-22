<?php

namespace Tinkoff\Business\Model;

class Bank
{
    /** @var string */
    private $accountNumber;

    /** @var string */
    private $corrAccount;

    /** @var string */
    private $bic;

    /** @var string */
    private $name;

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
    public function getCorrAccount(): ?string
    {
        return $this->corrAccount;
    }

    /**
     * @param string $corrAccount
     */
    public function setCorrAccount(string $corrAccount): void
    {
        $this->corrAccount = $corrAccount;
    }

    /**
     * @return string
     */
    public function getBic(): ?string
    {
        return $this->bic;
    }

    /**
     * @param string $bic
     */
    public function setBic(string $bic): void
    {
        $this->bic = $bic;
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
}
