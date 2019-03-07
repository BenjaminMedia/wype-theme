<?php

namespace Tests\Unit\Themes\Wype\App\Repositories;

use App\Models\User;
use App\Repositories\WypeUserRepository;
use Codeception\TestCase\WPTestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class WypeUserRepositoryTest extends TestCase
{
    public function testCanInstantiateRepository()
    {
        $client = new Client();
        $repo = new WypeUserRepository($client);

        $this->assertInstanceOf(WypeUserRepository::class, $repo);
    }

    public function testGetsUserFromValidateSubscriptionMethod()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'AgreementID' => '1234567890',
                'MarketID' => 0,
                'UserID' => '',
                'FirstName' => 'Test',
                'LastName' => 'Testerson',
                'PostalCode' => '2100',
                'CountryCode' => 'DK',
                'Email' => 'test.testerson@example.com',
                'Password' => '2100',
                'ExternalID' => '',
                'ServiceID' => 'BP_VIS_API',
                'IsValid' => true,
                'IsFound' => true,
                'IsTest' => true,
                'Prefix' => '',
                'ErrorCode' => 'NO_ERROR',
                'Magazines' => [
                    [
                        'PubCode' => 'DK_ILL',
                        'Title' => 'Illustreret Videnskab'
                    ]
                ],
                'Books' => []
            ]))
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $repo = new WypeUserRepository($client);
        $user = $repo->validateSubscription('1234567890', 2100);

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame('1234567890', $user->getSubscriptionNumber());
        $this->assertSame('Test', $user->getFirstName());
        $this->assertSame('Testerson', $user->getLastName());
        $this->assertSame('test.testerson@example.com', $user->getEmail());
        $this->assertSame('2100', $user->getPassword());
    }

    public function testRepositoryReturnsFalseWhenUserNotFound()
    {
        $mock = new MockHandler([
            new Response(500, [], '003  USER_NOT_FOUND'),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $repo = new WypeUserRepository($client);

        $response = $repo->validateSubscription('1234567890', 2100);

        $this->assertNull($response);
    }

    public function testRepositoryReturnsFalseWhenPasswordIsIncorrect()
    {
        $mock = new MockHandler([
            new Response(500, [], '002  INVALID_PASSWORD'),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $repo = new WypeUserRepository($client);

        $response = $repo->validateSubscription('1234567890', 2100);

        $this->assertNull($response);
    }

    public function testUserReturnedWhenCreatingLoginSuccessfully()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'AgreementID' => '1234567890',
                'MarketID' => 0,
                'UserID' => '',
                'FirstName' => '',
                'LastName' => '',
                'PostalCode' => '',
                'CountryCode' => 'DK',
                'Email' => 'test.testerson@example.com',
                'Password' => '123456',
                'ExternalID' => '',
                'ServiceID' => 'BP_VIS_API',
                'IsValid' => true,
                'IsFound' => false,
                'IsTest' => true,
                'Prefix' => '',
                'ErrorCode' => '',
                'Magazines' => [],
                'Books' => []
            ]))
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $repo = new WypeUserRepository($client);
        $user = $repo->createLogin('1234567890', 'test.testerson@example.com', '123456');

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame('1234567890', $user->getSubscriptionNumber());
        $this->assertNull($user->getFirstName());
        $this->assertNull($user->getLastName());
        $this->assertSame('test.testerson@example.com', $user->getEmail());
        $this->assertSame('123456', $user->getPassword());
        $this->assertNull($user->getErrorCode());
    }

    public function testNullReturnedWhenCreatingLoginWithInvalidData()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'AgreementID' => '1234567890',
                'MarketID' => 0,
                'UserID' => '',
                'FirstName' => '',
                'LastName' => '',
                'PostalCode' => '',
                'CountryCode' => 'DK',
                'Email' => 'test.testerson@example.com',
                'Password' => '123456',
                'ExternalID' => '',
                'ServiceID' => 'BP_VIS_API',
                'IsValid' => true,
                'IsFound' => false,
                'IsTest' => true,
                'Prefix' => '',
                'ErrorCode' => 'Operation failed',
                'Magazines' => [],
                'Books' => []
            ]))
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $repo = new WypeUserRepository($client);
        $response = $repo->createLogin('1234567890', 'test.testerson@example.com', '123456');
        $this->assertNull($response);
    }
}
