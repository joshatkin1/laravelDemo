<?php

namespace App\Abstracts;

use App\Models\ApiClient;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

abstract class Api {

    protected $apiClient;

    protected $curl;

    protected $response;

    public function __construct()
    {
        $this->apiClient->access_token = $this->authenticate();
    }

    private function authenticate()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->post($this->baseUrl . 'auth_token', [
            'client_secret' => $this->apiClient->client_secret,
            'client_id' => $this->apiClient->client_id,
            'grant_type' => $this->apiClient->grant_type,
        ]);

        return 'asdasdasd';

        return $response->json()['access_token'];
    }
}