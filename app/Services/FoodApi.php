<?php

namespace App\Services;

use App\Abstracts\Api as ApiAbstract;
use App\Models\ApiClient;
use App\Interfaces\FoodApi as FoodApiInterface;
use Illuminate\Support\Facades\Http;

class FoodApi extends ApiAbstract implements FoodApiInterface
{
    public function __construct(ApiClient $apiClient){
        $this->apiClient = $apiClient;

        parent::__construct();
    }

    public function getMenus() {
        $response = $this->apiClient->get($this->apiClient->BASE_URL . "/menus", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiClient->access_token
            ]
        ]);
        
        return json_decode($response->getBody()->getContents());
    }

    public function getMenuProducts(int $menuId):array
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

    public function updateProduct(int $menuId, int $productId, $updatedProductData)
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