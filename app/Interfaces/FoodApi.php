<?php

namespace App\Interfaces;

interface FoodApi
{
    public function getMenus();

    public function getMenuProducts();

    public function updateProduct();

}