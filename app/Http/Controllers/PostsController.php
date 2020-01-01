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

    public function index(){
        $user = auth()->user();
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->latest()->get();

        return view('posts.index', [
            'posts' => $posts,
            'user' => $user,
        ]);
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

        return redirect()->back();
        //return redirect('/profile/' . auth()->user()->id);
    }
}
