<?php

namespace App\Repositories;


use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

class WypeUserRepository
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $subscriptionId
     * @param int $postalCode
     * @return array|bool|mixed|object
     */
    public function validateSubscription(string $subscriptionId, int $postalCode): ?User
    {
        try {
            $response = $this->client->get('webaccess', [
                RequestOptions::QUERY => [
                    'ServiceID' => 'BP_VIS_API',
                    'CountryCode' => 'DK',
                    'AgreementID' => $subscriptionId,
                    'Password' => $postalCode,
                    'isTest' => 'true',
                ],
            ]);
            $userData = json_decode($response->getBody()->getContents());
            if (json_last_error() === JSON_ERROR_NONE) {
                $user = new User();
                return $user->fromObject($userData);
            }
            return null;
        } catch (RequestException $e) {
            // TODO ClientException
            return null;
        }
    }

    /**
     * @param string $subscriptionId
     * @param int $postalCode
     * @return array|bool|mixed|object
     */
    public function createLogin(string $subscriptionId, string $email, string $password): ?User
    {
        try {
            $response = $this->client->post('webaccess', [
                RequestOptions::JSON => [
                    'ServiceID' => 'BP_VIS_API',
                    'CountryCode' => 'DK',
                    'AgreementID' => $subscriptionId,
                    'Email' => $email,
                    'Password' => $password,
                    'isTest' => 'true',
                ],
            ]);
            $userData = json_decode($response->getBody()->getContents());
            if (json_last_error() === JSON_ERROR_NONE) {
                $user = new User();
                $user->fromObject($userData);
                if ($user->getErrorCode()) {
                    return null;
                }
                return $user;
            }
            return null;
        } catch (RequestException $e) {
            // TODO ClientException
            return null;
        }
    }

}
