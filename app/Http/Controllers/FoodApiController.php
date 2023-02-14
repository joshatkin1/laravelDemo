<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Octane\Facades\Octane;
use App\Interfaces\FoodApi;

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

    public function index(FoodApi $foodApi)
    {
        $data = [$menus, $products] = Octane::concurrently([
            fn () => $foodApi->getMenus(),
            fn () => $foodApi->getMenuProducts()
        ]);

        var_dump($data);

    }
}
