<?php

namespace App\Abstracts;

use App\Models\Client;
use Http\Client\Exception\HttpException;
use Illuminate\Support\Facades\Http;
use League\OAuth1\Client\Credentials\CredentialsException;

abstract class Api
{
    public $client;

    public function __construct(Client $apiClient)
    {
        $this->client = $apiClient;
        $this->authenticate();
    }

    /**
     * This sends the request to authenticate with the 3rd party api and receives the access_token upon success
     *
     * @return mixed
     * @throws CredentialsException
     */
    protected function authenticate(): mixed
    {
        if(empty($this->client->getClientSecret()) || empty($this->client->getClientId()) || empty($this->client->getGrantType())){
            throw new CredentialsException('missing client credentials');
        }

        $response = Http::withHeaders(['Accept' => 'application/json' ,'Content-Type' => 'application/x-www-form-urlencoded',])
            ->withOptions(['verify'=> false])
            ->post($this->client::BASE_URL . $this->client::AUTH_TOKEN_ENDPOINT, data: [
            'client_secret' => $this->client->getClientSecret(),
            'client_id' => $this->client->getClientId(),
            'grant_type' => $this->client->getGrantType(),
        ]);

        if (!$response->successful()) {
            throw new HttpException('Failed to authenticate with the 3rd party api');
        }

        return $response->json()['access_token'];
    }
}
