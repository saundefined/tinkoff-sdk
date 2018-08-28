<?php

namespace Tinkoff\Business\OAuth;

use GuzzleHttp\Client as HttpClient;
use Tinkoff\Business\Exception\ApiException;
use Tinkoff\Business\Exception\HttpException;
use Tinkoff\Business\Model\OAuthResponse;

class Client
{
    /**
     * @var string Идентификатор партнера (можно получить у персонального менеджера)
     */
    private $clientId;

    /**
     * @var string Пароль партнера (можно получить у персонального менеджера)
     */
    private $clientPassword;

    /**
     * @var string URL приложения, на который будет перенаправлен пользователь после завершения процесса
     *     аутентификации)
     */
    private $redirectUri;

    public function __construct($clientId, $clientPassword, $redirectUri)
    {
        $this->clientId = $clientId;
        $this->clientPassword = $clientPassword;
        $this->redirectUri = $redirectUri;
    }

    /**
     * @param string $state Маркер запроса - случайным образом сгенерированная на стороне приложения строка.
     *     Предназначена для корреляции запросов и ответов
     *
     * @return string
     */
    public function getAuthorizeUrl($state = ''): string
    {
        $params = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
        ];
        if ($state) {
            $params['state'] = $state;
        }

        return 'https://sso.tinkoff.ru/authorize?' . http_build_query($params);
    }

    /**
     * @param string $code
     *
     * @return OAuthResponse
     *
     * @throws ApiException
     * @throws HttpException
     */
    public function withCode($code): OAuthResponse
    {
        $result = $this->query([
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->redirectUri
        ]);

        $response = new OAuthResponse();
        if ($result['access_token']) {
            $response->setAccessToken($result['access_token']);
        }
        if ($result['token_type']) {
            $response->setTokenType($result['token_type']);
        }
        if ($result['expires_in']) {
            $response->setExpiresIn($result['expires_in']);
        }
        if ($result['id_token']) {
            $response->setIdToken($result['id_token']);
        }
        if ($result['refresh_token']) {
            $response->setRefreshToken($result['refresh_token']);
        }

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
        $client = new HttpClient();
        $response = $client->post('https://sso.tinkoff.ru/secure/token', [
            'auth' => [$this->clientId, $this->clientPassword],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => $params
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() !== 200) {
            throw new HttpException('Api response status code is not 200');
        }

        if ($result['errorCode'] && $result['errorMessage']) {
            throw new ApiException('[' . $result['errorCode'] . '] ' . $result['errorMessage']);
        }

        return $result;
    }

    /**
     * @param $refreshToken
     *
     * @return OAuthResponse
     *
     * @throws ApiException
     * @throws HttpException
     */
    public function refreshToken($refreshToken): OAuthResponse
    {
        $result = $this->query([
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'redirect_uri' => $this->redirectUri
        ]);

        $response = new OAuthResponse();
        if ($result['access_token']) {
            $response->setAccessToken($result['access_token']);
        }
        if ($result['token_type']) {
            $response->setTokenType($result['token_type']);
        }
        if ($result['expires_in']) {
            $response->setExpiresIn($result['expires_in']);
        }
        if ($result['id_token']) {
            $response->setIdToken($result['id_token']);
        }
        if ($result['refresh_token']) {
            $response->setRefreshToken($result['refresh_token']);
        }

        return $response;
    }
}