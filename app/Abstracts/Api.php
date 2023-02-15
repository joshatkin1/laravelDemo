<?php

namespace App\Abstracts;

use App\Services\ApiClient;
use Http\Client\Exception\HttpException;
use Illuminate\Support\Facades\Http;

abstract class Api
{
    /**
     * @var ApiClient $apiClient
     */
    protected $client;

    /**
     * This sends the request to authenticate with the 3rd party api and receives the access_token upon success
     *
     * @return mixed
     */
    protected function authenticate(): mixed
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->retry(2)->post($this->client->BASE_URL . 'auth_token', [
            'client_secret' => $this->client->client_secret,
            'client_id' => $this->client->client_id,
            'grant_type' => $this->client->grant_type,
        ]);

        if (!$response->successful()) {
            throw new HttpException('Failed to authenticate with the 3rd party api');
        }

        return $response->json()['access_token'];
    }
}
