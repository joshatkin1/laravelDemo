<?php

namespace App\Http\Controllers;

use Laravel\Octane\Facades\Octane;
use App\Interfaces\ApiClient;

class FoodApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(ApiClient $apiClient)
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
