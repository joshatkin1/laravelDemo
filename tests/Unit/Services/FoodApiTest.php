<?php

namespace Tests\Unit\Services;

use App\Services\ApiClient;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\TestCase;

class FoodApiTest extends TestCase
{
    protected $foodApiService;

    public function setUp(): void
    {
        parent::setUp();

        $this->foodApiService = new ApiClient(new ApiClient());
    }

    public function testGetMenus()
    {
        // Arrange
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
            '*/menus' => Http::response($expectedData, 200)
        ]);

        // Act
        $response = $this->foodApiService->getMenus();

        // Assert
        Http::assertSent(function ($request) {
            return $request->url() === $this->foodApiService->apiClient->BASE_URL . $this->foodApiService->apiClient->MENUS_ENDPOINT
                && $request->method() === 'GET';
        });

        $this->assertEquals($expectedData, $response);
    }

    public function testGetMenuProducts()
    {
        $products = $this->foodApiService->getMenuProducts('Takeaway');
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

        // Set the return value of getValue method
        $mock->expects($this->any())
            ->method('updateProduct')
            ->willReturn(true);


        $productId = 84;
        $menuId = 7;
        $updatedProduct = ['id' => $productId, 'name' => 'Chips'];

        $result = $this->foodApiService->updateProduct($menuId, $productId, $updatedProduct);

        $this->assertTrue($result);
    }
}
