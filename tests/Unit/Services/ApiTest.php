<?php

namespace Tests\Unit\Services;

use App\Services\Api;
use App\Models\Client;
use App\Services\FoodApi;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    protected $foodApi;
    protected $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->foodApi = new Api(new Client());
        $this->client = new Client();
    }

    public function testGetMenus()
    {
        $expectedData = [
            [
                'id' => 1,
                'name' => 'Main Menu'
            ],
            [
                'id' => 2,
                'name' => 'Dessert Menu'
            ]
        ];

        Http::fake([
            '*/' . $this->client->MENUS_ENDPOINT => Http::response($expectedData, 200)
        ]);

        $response = $this->FoodApiService->getMenus();

        Http::assertSent(function ($request) {
            return $request->url() === $this->client->BASE_URL . $this->client->MENUS_ENDPOINT
                && $request->method() === 'GET';
        });

        $this->assertEquals($expectedData, $response);
    }

    public function testGetMenuProducts()
    {
        $products = $this->foodApi->getMenuProducts('Takeaway');
        $this->assertIsArray($products);
        $this->assertNotEmpty($products);

        $expected =  [
            [
                "id" => 1,
                "name" => "Large Pizza"
            ],
            [
                "id" => 2,
                "name" => "Medium Pizza"
            ],
            [
                "id" => 3,
                "name" => "Burger"
            ],
            [
                "id" => 4,
                "name" => "Chips"
            ],
            [
                "id" => 5,
                "name" => "Soup"
            ],
            [
                "id" => 6,
                "name" => "Salad"
            ]
        ];

        $this->assertEquals($expected, $products);
    }

    public function testUpdateProduct()
    {
        $mock = $this->getMockBuilder(FoodApi::class)
            ->setMethods(['updateProduct'])
            ->getMock();

        $mock->expects($this->any())
            ->method('updateProduct')
            ->willReturn(true);


        $productId = 84;
        $menuId = 7;
        $updatedProduct = ['id' => $productId, 'name' => 'Chips'];

        $result = $this->foodApi->updateProduct($menuId, $productId, $updatedProduct);

        $this->assertTrue($result);
    }
}
