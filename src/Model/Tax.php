<?php

namespace Tinkoff\Business\Model;

use DateTime;

class Tax
{
    /**
     * Показатель основания налогового платежа
     * @var string $evidence
     */
    private $evidence;

    /**
     * Показатель налогового периода / Код таможенного органа
     * @var string $period
     */
    private $period;

    /**
     * Показатель номера документа
     * @var string $number
     */
    private $number;

    /**
     * Показатель даты документа
     * @var DateTime $date
     */
    private $date;

    /**
     * Показатель типа платежа
     * @var string $taxType
     */
    private $type;

    /**
     * @return string
     */
    public function getEvidence(): ?string
    {
        return $this->evidence;
    }

    /**
     * @param string $evidence
     */
    public function setEvidence(string $evidence): void
    {
        $this->evidence = $evidence;
    }

    /**
     * @return string
     */
    public function getPeriod(): ?string
    {
        return $this->period;
    }

    /**
     * @param string $period
     */
    public function setPeriod(string $period): void
    {
        $this->period = $period;
    }

    /**
     * @return string
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
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
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

}
