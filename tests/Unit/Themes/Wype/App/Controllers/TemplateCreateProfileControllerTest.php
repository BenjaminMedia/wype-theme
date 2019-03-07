<?php

namespace Tests\Unit\Themes\Wype\App\Controllers;

use App\Controllers\TemplateCreateProfile;
use App\Models\User;
use App\Repositories\WypeUserRepository;
use Codeception\TestCase\WPTestCase;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class TemplateCreateProfileControllerTest extends TestCase
{
    public function testCanInstantiateController()
    {
        /** @var WypeUserRepository $wype */
        $wype = $this->createMock(WypeUserRepository::class);
        /** @var Request $request */
        $request = $this->createMock(Request::class);
        /** @var Session $session */
        $session = $this->createMock(Session::class);
        $controller = new TemplateCreateProfile($wype, $request, $session);

        $this->assertInstanceOf(TemplateCreateProfile::class, $controller);
    }

    public function testCanProgressToStepTwo()
    {
        $user = new User();
        $user->setFirstName('Test')
            ->setLastName('Testerson')
            ->setEmail('test.testerson@example.com')
            ->setSubscriptionNumber('1234567890')
            ->setPassword('1234');

        /** @var WypeUserRepository $wype */
        $wype = $this->getMockBuilder(WypeUserRepository::class)
            ->setConstructorArgs([new Client()])
            ->setMethods(['validateSubscription'])
            ->getMock();

        $wype->expects($this->once())
            ->method('validateSubscription')
            ->with('1234567890', '1234')
            ->willReturn($user);

        $request = Request::create('/create-profile', 'POST', [
            'csrf' => 'super-secret-csrf-token',
            'validateSubscriptionNumber' => '1',
            'step' => '2',
            'subscriptionNumber' => '1234567890',
            'zip' => '1234',
        ]);

        /** @var Session $session */
        $session = $this->getMockBuilder(Session::class)
            ->setMethods(['get'])
            ->getMock();
        $session->method('get')
            ->with('csrf_token')
            ->willReturn('super-secret-csrf-token');

        $controller = new TemplateCreateProfile($wype, $request, $session);
        $controller->__before();

        $this->assertSame('2', $controller->step());
        $this->assertSame('Test', $controller->firstName());
        $this->assertSame('Testerson', $controller->lastName());
        $this->assertSame('test.testerson@example.com', $controller->email());
        $this->assertSame('1234567890', $controller->subscriptionNumber());
    }

    public function testControllerIgnoresPostRequestWithInvalidCSRFToken()
    {
        $user = new User();
        $user->setFirstName('Test')
            ->setLastName('Testerson')
            ->setEmail('test.testerson@example.com')
            ->setSubscriptionNumber('1234567890')
            ->setPassword('1234');

        // Mock Wype
        // In the mock, expect that validateSubscription and/or createUser is NEVER called

        /** @var WypeUserRepository $wype */
        $wype = $this->getMockBuilder(WypeUserRepository::class)
            ->setConstructorArgs([new Client()])
            ->getMock();

        $wype->expects($this->never())
            ->method('validateSubscription');

        $wype->expects($this->never())
            ->method('createUser');

        // Create a request with a mismatching CSRF token
        $request = Request::create('/create-profile', 'POST', [
            'csrf' => 'super-secret-csrf-token',
            'validateSubscriptionNumber' => '1',
            'step' => '2',
            'subscriptionNumber' => '1234567890',
            'zip' => '1234',
        ]);

        // Mock session
        // In the mock, set a CSRF token that does not match the one in the request
        /** @var Session $session */
        $session = $this->getMockBuilder(Session::class)
            ->setMethods(['get'])
            ->getMock();
        $session->method('get')
            ->with('csrf_token')
            ->willReturn('wrong-csrf-token');

        // Create controller
        $controller = new TemplateCreateProfile($wype, $request, $session);
        $controller->__before();

        // Make assertion, verifying that nothing happened
        $this->assertSame(1, $controller->step());
        $this->assertNull($controller->firstName());
        $this->assertNull($controller->lastName());
        $this->assertNull($controller->email());
        $this->assertNull($controller->subscriptionNumber());
    }

    /**
     * @dataProvider missingParameterOnValidateSubscriptionProvider
     */
    public function testMissingParametersOnValidateSubscriptionNumberReturnsToStepOne(/*array $params*/)
    {
        $user = new User();
        $user->setFirstName('Test')
            ->setLastName('Testerson')
            ->setEmail('test.testerson@example.com')
            ->setSubscriptionNumber('1234567890')
            ->setPassword('1234');

        // Mock Wype
        // In the mock, expect that validateSubscription is NEVER called

        /** @var WypeUserRepository $wype */
        $wype = $this->getMockBuilder(WypeUserRepository::class)
            ->setConstructorArgs([new Client()])
            ->getMock();

        $wype->expects($this->never())
            ->method('validateSubscription');

        // Create a request
        $request = Request::create('/create-profile', 'GET', [
            'csrf' => 'super-secret-csrf-token',
            'validateSubscriptionNumber' => '1',
            'step' => '2',
            'subscriptionNumber' => '1234567890',
            /*'zip' => '1234',*/
        ]);

        // Mock session
        /** @var Session $session */
        $session = $this->getMockBuilder(Session::class)
            ->setMethods(['get'])
            ->getMock();
        $session->method('get')
            ->with('csrf_token')
            ->willReturn('super-secret-csrf-token');

        // Create controller
        $controller = new TemplateCreateProfile($wype, $request, $session);
        // Run __before method
        $controller->__before();

        // Assert the step is set to 1
        $this->assertSame(1, $controller->step());
        // Assert firstname, lastname, email, password etc is null
        $this->assertNull($controller->firstName());
        $this->assertNull($controller->lastName());
        $this->assertNull($controller->email());
        $this->assertNull($controller->subscriptionNumber());
    }

    /**
     * @dataProvider missingParameterOnSubmitUserProvider
     */
    public function testMissingParametersOnSubmitUserReturnsToStepTwo(array $params)
    {
        $user = new User();
        $user->setFirstName('Test')
            ->setLastName('Testerson')
            ->setEmail('test.testerson@example.com')
            ->setSubscriptionNumber('1234567890')
            ->setPassword('1234');

        // Mock Wype
        // In the mock, expect that createLogin is NEVER called

        /** @var WypeUserRepository $wype */
        $wype = $this->getMockBuilder(WypeUserRepository::class)
            ->setConstructorArgs([new Client()])
            ->getMock();

        $wype->expects($this->never())
            ->method('createLogin');

        // Create a request
        $request = Request::create('/create-profile', 'POST', [
            'csrf' => 'super-secret-csrf-token',
            'validateSubscriptionNumber' => '1',
            'step' => '3',
            'subscriptionNumber' => '1234567890',
            /*'zip' => '1234',*/
        ]);

        // Mock session

        // Create controller
        // Run __before method

        // Assert the step is set to 2
        // Assert firstname, lastname, email, password etc is null
    }

    public function missingParameterOnValidateSubscriptionProvider()
    {
        return [
            'Missing Subscription Number' => [
                [
                    'csrf' => 'super-secret-csrf-token',
                    'validateSubscriptionNumber' => '1',
                    'step' => '2',
                    'zip' => '1234',
                ]
            ],
            'Empty Subscription Number' => [
                [
                    'csrf' => 'super-secret-csrf-token',
                    'validateSubscriptionNumber' => '1',
                    'step' => '2',
                    'subscriptionNumber' => '',
                    'zip' => '1234',
                ]
            ],
            'Missing Zip Code' => [
                'csrf' => 'super-secret-csrf-token',
                'validateSubscriptionNumber' => '1',
                'step' => '2',
                'subscriptionNumber' => '1234567890',
            ],
            'Empty Zip Code' => [
                'csrf' => 'super-secret-csrf-token',
                'validateSubscriptionNumber' => '1',
                'step' => '2',
                'subscriptionNumber' => '1234567890',
                'zip' => '',
            ]
        ];
    }

    public function missingParameterOnSubmitUserProvider()
    {
        return [
            'Missing Supscription Number' => [
                [
                    'csrf' => 'super-secret-csrf-token',
                    'submitUserInfo' => '1',
                    'step' => '3',
                    'email' => 'test.testerson@example.com',
                    'password' => '1234'
                ]
            ],
            'Empty Supscription Number' => [
                [
                    'csrf' => 'super-secret-csrf-token',
                    'submitUserInfo' => '1',
                    'step' => '3',
                    'subscriptionNumber' => '',
                    'email' => 'test.testerson@example.com',
                    'password' => '1234'
                ]
            ],
            'Missing Email' => [
                [
                    'csrf' => 'super-secret-csrf-token',
                    'submitUserInfo' => '1',
                    'step' => '3',
                    'subscriptionNumber' => '1234567890',
                    'password' => '1234'
                ]
            ],
            'Empty Email' => [
                [
                    'csrf' => 'super-secret-csrf-token',
                    'submitUserInfo' => '1',
                    'step' => '3',
                    'subscriptionNumber' => '1234567890',
                    'email' => '',
                    'password' => '1234'
                ]
            ],
            'Missing Password' => [
                [
                    'csrf' => 'super-secret-csrf-token',
                    'submitUserInfo' => '1',
                    'step' => '3',
                    'subscriptionNumber' => '1234567890',
                    'email' => 'test.testerson@example.com',
                ]
            ],
            'Empty password' => [
                [
                    'csrf' => 'super-secret-csrf-token',
                    'submitUserInfo' => '1',
                    'step' => '3',
                    'subscriptionNumber' => '1234567890',
                    'email' => 'test.testerson@example.com',
                    'password' => ''
                ]
            ],
        ];
    }
}
