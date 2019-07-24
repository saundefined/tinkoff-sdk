<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Tinkoff\Business\Exception\ApiException;
use Tinkoff\Business\Exception\HttpException;
use Tinkoff\Business\OAuth\Client;

final class OAuthClientTest extends TestCase
{
    public function testShouldReturnAccessToken(): void
    {
        $data = [
            'access_token' => 'MZlKw2FjKp3i1sD4hs2CxEeqzmfBdFEHSDQbFcYQoz7DLoBZyiYDFQ4JoTPs5jnZfL7O0JpLQRUWeNK1lFxH9Y',
            'token_type' => 'Bearer',
            'expires_in' => 1800,
            'refresh_token' => 'eU9Qcx64h0llffyCprqNl7JToj7DI9WmlfpsAh7yTw8Iozyxon3YCQ1kUWH0Pi2PVw8M9vMDw2j3zAG4ntFej8',
            'sessionId' => 'Dmmru8eqe6S8eU1Q4c9PVjAIEaRfCaIhDrr4NHKFLsJEPuw6QeYyf9IfPgJgIXBhvUkBxarwW60mso1fVplT5E'
        ];

        $client = $this->createClient($data);

        $response = $client->renew();

        $this->assertSame($data['access_token'], $response->getAccessToken());
        $this->assertSame($data['token_type'], $response->getTokenType());
        $this->assertSame($data['expires_in'], $response->getExpiresIn());
        $this->assertSame($data['refresh_token'], $response->getRefreshToken());
        $this->assertSame($data['sessionId'], $response->getSessionId());
    }

    private function createClient($data = [], $httpStatus = 200): Client
    {
        $mock = new MockHandler([
            new Response($httpStatus, [], json_encode($data))
        ]);
        $handler = HandlerStack::create($mock);

        $client = new Client('client_id', 'client_secret', 'refresh_token');
        $client->setClient(new \GuzzleHttp\Client(['handler' => $handler]));

        return $client;
    }

    public function testShouldReturnUnauthorizedException(): void
    {
        $client = $this->createClient([
            'errorMessage' => 'Непредвиденная ошибка. Пожалуйста, попробуйте позже.',
            'errorCode' => 'INTERNAL_ERROR',
            'success' => false
        ], 401);

        $this->expectException(HttpException::class);

        $client->renew();
    }

    public function testShouldReturnApiErrorException(): void
    {
        $client = $this->createClient([
            'errorMessage' => 'Непредвиденная ошибка. Пожалуйста, попробуйте позже.',
            'errorCode' => 'INTERNAL_ERROR',
            'success' => false
        ]);

        $this->expectException(ApiException::class);

        $client->renew();
    }
}
