<?php

namespace Tinkoff\Business\Model;

use Tinkoff\Business\Base\BaseModel;

class Balance extends BaseModel
{
    /**
     * ОТВ счета
     * @var float $otb
     */
    private $otb;

    /**
     * Сумма авторизаций (захолдированные на счете средства)
     * @var float $authorized
     */
    private $authorized;

    /**
     * Сумма платежей в картотеке клиента (собственные платежи)
     * @var float $pendingPayments
     */
    private $pendingPayments;

    /**
     * Сумма платежей в картотеке банка (требования к клиенту)
     * @var float $pendingRequisitions
     */
    private $pendingRequisitions;

    /**
     * @return float
     */
    public function getOtb(): ?float
    {
        return $this->otb;
    }

    /**
     * @param float $otb
     */
    public function setOtb(float $otb): void
    {
        $this->otb = $otb;
    }

    /**
     * @return float
     */
    public function getAuthorized(): ?float
    {
        return $this->authorized;
    }

    /**
     * @param float $authorized
     */
    public function setAuthorized(float $authorized): void
    {
        $this->authorized = $authorized;
    }

    /**
     * @return float
     */
    public function getPendingPayments(): ?float
    {
        return $this->pendingPayments;
    }

    /**
     * @param float $pendingPayments
     */
    public function setPendingPayments(float $pendingPayments): void
    {
        $this->pendingPayments = $pendingPayments;
    }

    /**
     * @return float
     */
    public function getPendingRequisitions(): ?float
    {
        return $this->pendingRequisitions;
    }

    /**
     * @param float $pendingRequisitions
     */
    public function setPendingRequisitions(float $pendingRequisitions): void
    {
        $this->pendingRequisitions = $pendingRequisitions;
    }
}