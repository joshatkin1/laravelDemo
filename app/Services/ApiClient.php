<?php

namespace App\Services;

use App\Abstracts\Api as ApiAbstract;
use App\Models\Client;
use App\Interfaces\ApiClient as ApiClientInterface;
use Illuminate\Support\Facades\Http;

class ApiClient extends ApiAbstract implements ApiClientInterface
{
    public function __construct(Client $apiClient){
        $this->apiClient = $apiClient;

        $this->authenticate();

        parent::__construct();
    }

    public function getMenus(): mixed
    {
        $response = $this->apiClient->get($this->apiClient->BASE_URL . "/menus", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiClient->access_token
            ]
        ]);
        
        return json_decode($response->getBody()->getContents());
    }

    public function getMenuProducts(int $menuId): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiClient->access_token,
        ])->get($this->apiClient->BASE_URL . 'menu/' . $menuId . '/products');

        if($response->failed()){
            throw new \HttpRequestException('api call failed');
        }

        $products = collect($response->json())->filter(function ($product) {
            return $product['status'] === 'active';
        })->map(function ($product) {
            return [
                'id' => $product['id'],
                'name' => $product['name'],
            ];
        });

        return $products;
    }

    public function updateProduct(int $menuId, int $productId, $updatedProductData): bool
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiClient->access_token,
        ])->put($this->apiClient->BASE_URL . 'menu/' . $menuId . '/product/' . $productId, $updatedProductData);

        if($response->failed()){
            throw new \HttpRequestException('api call failed');
        }

        return $response->ok();
    }
}