<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserController extends Controller
{
    /**
     * Show the application user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data = [
            'users' =>  new UserCollection(User::all()),
        ];

        return view(view: 'users', data: $data);
    }
}
