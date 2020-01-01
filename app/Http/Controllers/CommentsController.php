<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('comments.create');
    }

    public function store($post)
    {
        $_post = Post::Find($post);

        $data = request()->validate([
            'comment_text' => 'required',
        ]);

        //dd($_post->id);

        auth()->user()->comments()->create([
            'comment_text' => $data['comment_text'],
            'post_id' => $_post->id,
        ]);

        return redirect()->back();
    }
}
