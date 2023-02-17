<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
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
        $data = [
            'users' => new UserCollection(User::all())
        ];

        return view(view: 'users', data: $data);
    }

    /**
     * Show the application user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user(UserProfileRequest $request, $id)
    {
        $data = [
            'user' => new UserResource(User::find(request()->id))
        ];

        return view(view: 'user', data: $data);
    }
}
