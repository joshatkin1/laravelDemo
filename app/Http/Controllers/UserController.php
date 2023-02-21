<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Post;
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
    public function index()
    {
        if(! $users = Cache::get('users')){
            $users = new  UserCollection(User::all());
            Cache::add('users', $users, ttl: 100);
        }

        return view(view: 'users.all', data: compact('users'));
    }

    public function create()
    {
        return view(view: 'users.create');
    }

    public function store(CreatePostRequest $request)
    {
        Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return to_route('users');
    }

    public function update(Request $request)
    {
        $data = $request->only(['name', 'job']);

        Post::update($data);

        return to_route('posts');
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
