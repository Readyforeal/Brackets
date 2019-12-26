<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'post_text' => 'required',
        ]);

        auth()->user()->posts()->create($data);

        return redirect('/profile/' . auth()->user()->id);
    }
}
