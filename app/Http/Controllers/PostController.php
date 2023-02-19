<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(CreatePostRequest $request)
    {
        Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return to_route('posts');
    }


}
