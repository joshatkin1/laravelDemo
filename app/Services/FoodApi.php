<?php

namespace App\Services;

use App\Models\Client;
use Illuminate\Support\Facades\Http;

class FoodApi extends ApiClient
{
    /**
     * This sends the request to get the menus from api
     *
     * @return mixed
     * @throws \HttpRequestException
     */
    public function getMenus(): mixed
    {
        return [];
        $response = $this->client->get($this->client->BASE_URL . "/menus", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->client->access_token
            ]
        ]);

        if ($response->failed()) {
            throw new \HttpRequestException('api call failed');
        }

        return json_decode($response->getBody()->getContents());
    }

    /**
     * This sends api request to get specific menu products
     *
     * @return array
     * @throws \HttpRequestException
     */
    public function getMenuProducts(int $menuId): array
    {
        return [];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->client->access_token,
        ])->get($this->client->BASE_URL . 'menu/' . $menuId . '/products');

        if ($response->failed()) {
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

    /**
     * This sends the request to update the product
     *
     * @return bool
     * @throws \HttpRequestException
     */
    public function updateProduct(int $menuId, int $productId, $updatedProductData): bool
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->client->access_token,
        ])->put($this->client->BASE_URL . 'menu/' . $menuId . '/product/' . $productId, $updatedProductData);

        if ($response->failed()) {
            throw new \HttpRequestException('api call failed');
        }

        return $response->ok();
    }
}