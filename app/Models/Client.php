<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**TODO::CHANGE THIS INTO A CRUD MODEL WITH MIGRATION SO IT WORKS WITH MULTIPLE API CLIENTS*/

    public const BASE_URL = "https://greatfoodltd.com/api/";

    public const AUTH_TOKEN_ENDPOINT = "auth_token";

    public const MENUS_ENDPOINT = "menus";

    public const PRODUCTS_ENDPOINT = "menu/{menu_id}/products";

    public const PRODUCT_ENDPOINT = "menu/{menu_id}/product/{product_id}";

    protected $access_token = null;

    private $client_secret = "4j3g4gj304gj3";

    private $client_id = "1337";

    private $grant_type = "client_credentials";
}
