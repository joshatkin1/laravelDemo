<?php

namespace App\Services;

use App\Abstracts\Api as ApiAbstract;
use App\Interfaces\ApiClient as ApiClientInterface;
use App\Models\Client;

class ApiClient extends ApiAbstract implements ApiClientInterface
{
    /**
     * This sets the api client
     *
     * @param Client $client
     * @return void
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }
}
