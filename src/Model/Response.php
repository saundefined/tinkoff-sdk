<?php

namespace Tinkoff\Business\Model;

class Response
{
    /**
     * @var string $requestId
     */
    private $requestId;

    /**
     * @var string $result
     */
    private $result;

    /**
     * @return string
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    /**
     * @param string $requestId
     */
    public function setRequestId(?string $requestId): void
    {
        $this->requestId = $requestId;
    }

    /**
     * @return string
     */
    public function getResult(): ?string
    {
        return $this->result;
    }

    /**
     * @param string $result
     */
    public function setResult(?string $result): void
    {
        $this->result = $result;
    }

    public function isSuccess(): bool
    {
        return $this->result === 'OK';
    }

}
