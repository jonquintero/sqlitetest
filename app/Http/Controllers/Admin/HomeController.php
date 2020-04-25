<?php

namespace App\Http\Controllers\Admin;

use App\Post;

class HomeController
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(4);

        return view('home', compact('posts'));
    }
}
