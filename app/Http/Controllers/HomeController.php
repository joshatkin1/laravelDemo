<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        User::factory()->count(3)->create();
        return view('home');
    }
}
