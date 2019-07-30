<?php

namespace Tinkoff\Business;

use GuzzleHttp\Client as GuzzleClient;
use Tinkoff\Business\Exception\ApiException;
use Tinkoff\Business\Exception\ArgumentException;
use Tinkoff\Business\Exception\HttpException;
use Tinkoff\Business\Model;

class Client
{
    private $inn;

    private $access_token;

    private $client;

    public function __construct($inn)
    {
        $this->inn = $inn;

        $this->client = new GuzzleClient([
            'base_uri' => 'https://openapi.tinkoff.ru/partner/company/' . $this->inn . '/'
        ]);
    }

    public function setClient(GuzzleClient $client): void
    {
        $this->client = $client;
    }

    /**
     * Получение списка счетов
     *
     * @return Account
     */
    public function accounts(): Account
    {
        return new Account($this);
    }

    /**
     * Получение выписки по счету
     * @param Model\Account $account
     *
     * @return Operation
     */
    public function operations(Model\Account $account): Operation
    {
        return new Operation($this, $account);
    }

    /**
     * Отправка платежного поручения
     * @param Model\Payment $payment
     *
     * @return Payment
     */
    public function payment(Model\Payment $payment): Payment
    {
        return new Payment($this, $payment);
    }

    /**
     * Запрос к API
     *
     * @param string $command
     * @param array $options
     * @param string $method
     *
     * @return array
     * @throws ArgumentException
     * @throws HttpException
     * @throws ApiException
     */
    public function query($command, array $options = [], $method = 'GET'): array
    {
        if (($this->inn === null) || ($this->access_token === null)) {
            throw new ArgumentException('Parameters inn and access_token are required');
        }

        $data = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
                'Content-Type' => 'application/json'
            ],
            'http_errors' => false,
        ];

        if ($method === 'GET') {
            $data['query'] = $options;
            $response = $this->client->get($command, $data);
        } else {
            $data['body'] = json_encode($options);
            $response = $this->client->post($command, $data);
        }

        $result = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() !== 200) {
            throw new HttpException('Api response status code is not 200');
        }

        if (isset($result['errorMessage'], $result['errorCode'])) {
            throw new ApiException('[' . $result['errorCode'] . '] ' . $result['errorMessage']);
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @param string $access_token
     */
    public function setAccessToken($access_token): void
    {
        $this->access_token = $access_token;
    }

    /**
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }
}
