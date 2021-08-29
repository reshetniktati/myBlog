<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('posts.index', [
           'posts' => Post::latest()->paginate(10),
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required'],
            'teaser' => ['nullable'],
            'body' => ['required'],
        ]);

        $post = new Post();
        $id = auth()->user()->id;

        $post->title = request('title');
        $post->body = request('body');
        $post->teaser = request('teaser');
        $post->user_id = $id;

        $post->save();

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $id)
    {
        $post = Post::all()->find($id);
        if (Gate::denies('update', $post)){
            abort(403, 'not allow');
        }

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Post $id)
    {
        $post = Post::all()->find($id);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $id)
    {
        $request->validate([
            'title' => ['required'],
            'teaser' => ['nullable'],
            'body' => ['required'],
        ]);

        $user_id = auth()->user()->id;

        $post = Post::all()->find($id);

        $post->title = request('title');
        $post->body = request('body');
        $post->teaser = request('teaser');
        $post->user_id = $user_id;

        $post->save();

        return redirect('/posts/'. $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
