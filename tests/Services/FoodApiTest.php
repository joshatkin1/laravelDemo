<?php

namespace Tests\Services;

use App\Models\ApiClient;
use PHPUnit\Framework\TestCase;
use App\Services\FoodApi;

class FoodApiTest extends TestCase
{
    protected $foodApiService;

    public function setUp(): void
    {
        parent::setUp();

        $this->foodApiService = new FoodApi(new ApiClient());
    }

    public function testGetMenus()
    {
        $this->
    }

    public function testGetMenuProducts()
    {
        $products = $this->foodApiService->getMenuProducts('Takeaway');
        $this->assertIsArray($products);
        $this->assertNotEmpty($products);

        $expected = [
            ['id' => 4, 'name' => 'Burger'],
            ['id' => 5, 'name' => 'Chips'],
            ['id' => 99, 'name' => 'Lasagna'],
        ];

        $this->assertEquals($expected, $products);
    }

    public function testUpdateProduct()
    {

        $mock = $this->getMockBuilder(FoodApi::class)
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
