<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Show the application user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = [];

        return view(view: 'posts.all', data: compact('posts'));
    }

    public function create()
    {
        return view(view: 'posts.create');
    }

    public function store(CreatePostRequest $request)
    {
        Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return to_route('posts');
    }

    public function update(Request $request)
    {
        $data = $request->only(['name', 'job']);

        Post::update($data);

        return to_route('posts');
    }

}
