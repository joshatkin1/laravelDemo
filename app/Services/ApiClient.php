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
     * @return $this|ApiClient
     */
    public function setClient(Client $client): ApiClient
    {
        $this->client = $client;
        return $this;
    }
}
