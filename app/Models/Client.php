<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{
    use HasApiTokens, HasFactory;

    protected $access_token = null;

    private $client_secret = "4j3g4gj304gj3";

    private $client_id = "1337";

    private $grant_type = "client_credentials";

    const BASE_URL = "https://localhost:8000/api/";

    const AUTH_TOKEN_ENDPOINT = "auth_token";

    const MENUS_ENDPOINT = "menus";

    const PRODUCTS_ENDPOINT = "menu/{menu_id}/products";

    const PRODUCT_ENDPOINT = "menu/{menu_id}/product/{product_id}";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_secret',
        'access_token',
        'client_id',
        'grant_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'client_secret',
        'access_token',
        'client_id',
        'grant_type',
    ];

    public function __construct()
    {
        parent::__construct();
    }

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
