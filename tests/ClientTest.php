<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Tinkoff\Business\Client;
use Tinkoff\Business\Exception\ApiException;
use Tinkoff\Business\Exception\ArgumentException;
use Tinkoff\Business\Exception\HttpException;

final class ClientTest extends TestCase
{
    public function testShouldReturnInn(): void
    {
        $client = new Client('760000000000');

        $this->assertSame('760000000000', $client->getInn());
    }

    public function testShouldReturnAccessToken(): void
    {
        $client = new Client('760000000000');
        $client->setAccessToken('MZlKw2FjKp3i1sD4hs2CxEeqzmfBdFEHSDQbFcYQoz7DLoBZyiYDFQ4JoTPs5jnZfL7O0JpLQRUWeNK1lFxH9Y');

        $this->assertSame('MZlKw2FjKp3i1sD4hs2CxEeqzmfBdFEHSDQbFcYQoz7DLoBZyiYDFQ4JoTPs5jnZfL7O0JpLQRUWeNK1lFxH9Y',
            $client->getAccessToken());
    }

    public function testShouldReturnHasNotAccessTokenException(): void
    {
        $client = new Client('760000000000');

        $this->expectException(ArgumentException::class);

        $client->query('test');
    }

    public function testShouldPreparePostQuery(): void
    {
        $client = $this->createClient([
            'success' => true
        ]);
        $client->setAccessToken('MZlKw2FjKp3i1sD4hs2CxEeqzmfBdFEHSDQbFcYQoz7DLoBZyiYDFQ4JoTPs5jnZfL7O0JpLQRUWeNK1lFxH9Y');

        $result = $client->query('test', [], 'POST');

        $this->assertTrue($result['success']);
    }

    private function createClient($data = [], $httpStatus = 200): Client
    {
        $mock = new MockHandler([
            new Response($httpStatus, [], json_encode($data))
        ]);
        $handler = HandlerStack::create($mock);

        $client = new Client('760000000000');
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
        $client->setAccessToken('MZlKw2FjKp3i1sD4hs2CxEeqzmfBdFEHSDQbFcYQoz7DLoBZyiYDFQ4JoTPs5jnZfL7O0JpLQRUWeNK1lFxH9Y');

        $this->expectException(HttpException::class);

        $client->query('test');
    }

    public function testShouldReturnApiErrorException(): void
    {
        $client = $this->createClient([
            'errorText' => 'Непредвиденная ошибка. Пожалуйста, попробуйте позже.',
            'errorCode' => 'INTERNAL_ERROR',
            'success' => false
        ]);
        $client->setAccessToken('MZlKw2FjKp3i1sD4hs2CxEeqzmfBdFEHSDQbFcYQoz7DLoBZyiYDFQ4JoTPs5jnZfL7O0JpLQRUWeNK1lFxH9Y');

        $this->expectException(ApiException::class);

        $client->query('test');
    }
}
