<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**TODO::CHANGE THIS INTO A CRUD MODEL WITH MIGRATION SO IT WORKS WITH MULTIPLE API CLIENTS*/

    const BASE_URL = "https://localhost:8000/api/";

    const AUTH_TOKEN_ENDPOINT = "auth_token";

    const MENUS_ENDPOINT = "menus";

    const PRODUCTS_ENDPOINT = "menu/{menu_id}/products";

    const PRODUCT_ENDPOINT = "menu/{menu_id}/product/{product_id}";

    protected $access_token = null;

    private $client_secret = "4j3g4gj304gj3";

    private $client_id = "1337";

    private $grant_type = "client_credentials";

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->client_id;
    }

    /**
     * @return string
     */
    public function getGrantType(): string
    {
        return $this->grant_type;
    }
}
