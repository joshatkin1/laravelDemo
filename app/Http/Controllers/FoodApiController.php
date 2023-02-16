<?php

namespace App\Http\Controllers;

use App\Interfaces\ApiClient;
use Laravel\Octane\Facades\Octane;

class FoodApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * This is the food api index which simply var_dumps out the api data
     *
     * @param ApiClient $apiClient
     *
     * @return string
     *
     * TODO:: make this return a simple vue ui
     */
    public function index(ApiClient $apiClient): string
    {
        //JUST OCTANE SWOOLE CONCURRENCY EXAMPLE, CURRENTLY NOT HOOKED UP & WORKING
        return 'NOT HOOKED UP & WORKING';

        $data = [$menus, $products] = Octane::concurrently([
            fn () => $apiClient->getMenus(),
            fn () => $apiClient->getMenuProducts()
        ]);

        var_dump($data);
    }
}
