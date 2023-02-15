<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * THIS WOULD BE MADE INTO A CRUD MODEL TO STORE ALL CLIENT DETAILS IN A DATABASE TABLE
     * SO THAT IT WORKS WITH MULTIPLE CLIENTS
     */

    const BASE_URL = "https://greatfoodltd.com/api/";
    const AUTH_TOKEN_ENDPOINT = "auth_token";
    const MENUS_ENDPOINT = "menus";
    const PRODUCTS_ENDPOINT = "menu/{menu_id}/products";
    const PRODUCT_ENDPOINT = "menu/{menu_id}/product/{product_id}";
    protected $access_token = null;
    private $client_secret = "4j3g4gj304gj3";
    private $client_id = "1337";
    private $grant_type = "client_credentials";
}
