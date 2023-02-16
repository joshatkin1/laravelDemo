<?php

namespace App\Interfaces;

use App\Models\Client;

interface ApiClient
{
    public function setClient(Client $client);
}
