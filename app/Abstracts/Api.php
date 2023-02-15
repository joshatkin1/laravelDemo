<?php

namespace App\Abstracts;

use App\Models\Client;
use Exception;
use Http\Client\Exception\HttpException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

abstract class Api {

    protected $apiClient;

    protected $curl;

    protected $response;

    public function __construct(){}

    protected function authenticate()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->retry(2)->post($this->apiClient->BASE_URL . 'auth_token', [
            'client_secret' => $this->apiClient->client_secret,
            'client_id' => $this->apiClient->client_id,
            'grant_type' => $this->apiClient->grant_type,
        ]);

        if(!$response->successful()){
            throw new HttpException('Failed to authenticate with the 3rd party api');
        }

        return $response->json()['access_token'];
    }
}