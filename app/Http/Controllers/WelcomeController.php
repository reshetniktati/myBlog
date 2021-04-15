<?php


namespace App\Http\Controllers;

use App\Models\Post;


class WelcomeController extends Controller
{
    public function index()
    {
        $posts = Post::all()->take(5);

        return view('welcome', [
            'posts' => $posts,
        ]);
    }
}
