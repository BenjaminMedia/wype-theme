<?php
namespace App\Http;

use ErrorException;
use GuzzleHttp\Client;

class BmdClient extends Client
{
    public function __construct(string $bmdEndpoint, string $apiToken)
    {
        if (!parse_url($bmdEndpoint)) {
            throw new ErrorException('Invalid BMD Endpoint, please check your input');
        }

        parent::__construct([
            'base_uri' => $bmdEndpoint,
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $apiToken),
            ]
        ]);
    }
}
