<?php

namespace App\Interfaces;

interface ApiClient
{
    public function getMenus();

    public function getMenuProducts();

    public function updateProduct();
}
