<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\WypeUserRepository;
use Sober\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class TemplateCreateProfile extends Controller
{
    protected $step = 1;
    protected $response = null;
    /** @var User|null */
    protected $user = null;
    /* @var WypeUserRepository */
    protected $repository;
    /** @var Request */
    protected $request;
    protected $session;

    public function __construct(WypeUserRepository $wype, Request $request, Session $session)
    {
        //throw new \Exception('For satan da!');
        $this->repository = $wype;
        $this->request = $request;
        $this->session = $session;

        if (!$this->session->get('csrf_token')) {
            $this->session->set('csrf_token', hash('sha512', uniqid()));
        }

        print "<h3>Controller __construct()</h3>";
    }

    public function __before()
    {
        parent::__before();
        if ($this->request->isMethod(Request::METHOD_POST)) {
            //throw new \Exception('POST');
            $this->handlePost();
        }
    }

    private function handlePost()
    {
        //dd($this->request->request->get('csrf'));
        //dd($this->session->get('csrf_token'));
        if ($this->request->request->get('csrf') !== $this->session->get('csrf_token')) {
            return;
        }

        $this->step = $this->request->request->get('step', 1);
        if ($this->request->request->get('validateSubscriptionNumber')) {
            $this->validateSubscriptionNumber();
        } elseif ($this->request->request->get('submitUserInfo')) {
            $this->submitUser();
        }
    }

    private function validateSubscriptionNumber()
    {
        $subscriptionNumber = $this->request->request->get('subscriptionNumber');
        $zip        = $this->request->request->get('zip');
        // Check for missing parameters
        if (!$subscriptionNumber || !$zip) {
            // View step 1
            $this->step = 1;
            return;
        }
        $this->user = $this->repository->validateSubscription($subscriptionNumber, $zip);
    }

    private function submitUser()
    {
        $subscriptionNumber = $this->request->request('subscriptionNumber');
        $email      = $this->request->request('email');
        $password   = $this->request->request('password');

        // Check for missing parameters
        if (!$subscriptionNumber || !$email || !$password) {
            $this->step = 2;
            return;
        }

        /*        $this->request('POST', 'webaccess', [
                    'ServiceID' => 'BP_VIS_API',
                    'CountryCode' => 'DK',
                    'AgreementID' => $subscriptionNumber,
                    'Email' => $email,
                    'Password' => $zip,
                    'isTest' => 'true',
                ]);*/
    }

    public function firstName(): ?string
    {
        return optional($this->user)->getFirstName();
    }

    public function lastName(): ?string
    {
        return optional($this->user)->getLastName();
    }

    public function email(): ?string
    {
        return optional($this->user)->getEmail();
    }

    public function subscriptionNumber()
    {
        return optional($this->user)->getSubscriptionNumber();
    }

    public function step()
    {
        return $this->step;
    }

    public function csrfToken()
    {
        return $this->session->get('csrf_token');
    }
}
