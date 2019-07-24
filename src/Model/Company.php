<?php

namespace Tinkoff\Business\Model;

class Company
{
    /** @var string */
    private $name;

    /** @var string */
    private $inn;

    /** @var string */
    private $kpp;

    /** @var Bank */
    private $bank;

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
     * @return string
     */
    public function getInn(): ?string
    {
        return $this->inn;
    }

    /**
     * @param string $inn
     */
    public function setInn(?string $inn): void
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
    public function setKpp(?string $kpp): void
    {
        $this->kpp = $kpp;
    }

    /**
     * @return Bank
     */
    public function getBank(): ?Bank
    {
        return $this->bank;
    }

    /**
     * @param Bank $bank
     *
     * @return void
     */
    public function setBank(?Bank $bank): void
    {
        $this->bank = $bank;
    }
}
