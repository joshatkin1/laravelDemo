<?php

namespace App\Interfaces;

interface ApiClient
{
    public function getMenus();

    public function getMenuProducts(int $menuId);

    public function updateProduct(int $menuId, int $productId, $updatedProductData);
}
