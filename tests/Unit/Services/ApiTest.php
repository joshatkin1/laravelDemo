<?php

namespace Tests\Unit\Services;

use App\Services\ApiClient;
use App\Models\Client;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    protected $ApiService;
    protected $ApiClient;

    public function setUp(): void
    {
        parent::setUp();

        $this->ApiService = new ApiClient(new Client());
        $this->ApiClient = new Client();
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
            '*/' . $this->ApiClient->MENUS_ENDPOINT => Http::response($expectedData, 200)
        ]);

        $response = $this->ApiService->getMenus();

        Http::assertSent(function ($request) {
            return $request->url() === $this->ApiClient->BASE_URL . $this->ApiClient->MENUS_ENDPOINT
                && $request->method() === 'GET';
        });

        $this->assertEquals($expectedData, $response);
    }

    public function testGetMenuProducts()
    {
        $products = $this->ApiService->getMenuProducts('Takeaway');
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
        $mock = $this->getMockBuilder(ApiClient::class)
            ->setMethods(['updateProduct'])
            ->getMock();

        $mock->expects($this->any())
            ->method('updateProduct')
            ->willReturn(true);


        $productId = 84;
        $menuId = 7;
        $updatedProduct = ['id' => $productId, 'name' => 'Chips'];

        $result = $this->ApiService->updateProduct($menuId, $productId, $updatedProduct);

        $this->assertTrue($result);
    }
}
