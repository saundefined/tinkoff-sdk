<?php

namespace Tinkoff\Business\OAuth;

use GuzzleHttp\Client as GuzzleClient;
use Tinkoff\Business\Exception\ApiException;
use Tinkoff\Business\Exception\HttpException;
use Tinkoff\Business\Model\OAuthResponse;

class Client
{
    /**
     * Данные для авторизации можно посмотреть в личном кабинете
     *
     * Действия > Интеграции > API Тинькофф > Параметры
     */

    /** @var string Client ID */
    private $clientId;

    /** @var string Client secret */
    private $clientSecret;

    /** @var string Refresh token */
    private $refreshToken;

    private $client;

    public function __construct($clientId, $clientSecret, $refreshToken)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->refreshToken = $refreshToken;

        $this->client = new GuzzleClient([
            'http_errors' => false,
        ]);
    }

    public function setClient(GuzzleClient $client): void
    {
        $this->client = $client;
    }

    /**
     *
     * @return OAuthResponse
     *
     * @throws ApiException
     * @throws HttpException
     */
    public function renew(): OAuthResponse
    {
        $result = $this->query([
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->refreshToken,
        ]);

        $response = new OAuthResponse();
        $response->setAccessToken($result['access_token']);
        $response->setTokenType($result['token_type']);
        $response->setExpiresIn($result['expires_in']);
        $response->setSessionId($result['sessionId']);
        $response->setRefreshToken($result['refresh_token']);

        return $response;
    }

    /**
     * @param $params
     *
     * @return array
     *
     * @throws ApiException
     * @throws HttpException
     */
    private function query($params): array
    {
        $response = $this->client->post('https://openapi.tinkoff.ru/sso/secure/token', [
            'auth' => [$this->clientId, $this->clientSecret],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => $params,
            'http_errors' => false
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() !== 200) {
            throw new HttpException('Api response status code is not 200');
        }

        if (isset($result['errorMessage'], $result['errorCode'])) {
            throw new ApiException('[' . $result['errorCode'] . '] ' . $result['errorMessage']);
        }

        return $result;
    }
}
