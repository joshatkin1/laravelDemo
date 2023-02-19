<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{

    /**
     * Show the application user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(! $users = Cache::get('users')){
            $users = new  UserCollection(User::all());
            Cache::add('users', $users, ttl: 100);
        }

        return view(view: 'users', data: compact('users'));
    }

    /**
     * Show the application user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user(Request $request, $id)
    {
        if(! $user = Cache::get('user_' . $id)){
            $user = new UserResource(User::find(request()->id));
            Cache::add('user_' . $id, $user, ttl: 100);
        }

        $data = [
            'user' => $user
        ];

        return view(view: 'user', data: $data);
    }
}
