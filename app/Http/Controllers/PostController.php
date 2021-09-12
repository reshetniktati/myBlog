<?php

namespace App\Http\Controllers;

use App\Events\NewPostAdded;
use App\Models\Post;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class PostController extends Controller
{

    public function validatePost() {
        return request()->validate([
            'title' => ['required'],
            'teaser' => ['nullable'],
            'body' => ['required'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('posts.index', [
           'posts' => Post::with('user')->latest()->paginate(10),
           'user' => auth()->user()->name,
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
    public function store()
    {
        $subscribers = Subscriber::all()->pluck('subscriber_user_id')->toArray();

        $id = auth()->user()->id;
//        dd(User::where('id', 3)->first()->name);


        foreach ($subscribers as $subscriber_id) {
            $subscriber = User::where('id', $subscriber_id)->first();
            event(new NewPostAdded(auth()->user(), $subscriber));
        }

        Post::create(
            array_merge(
                ['user_id' => $id],
                $this->validatePost(),
            )
        );

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
//        if (Gate::denies('update', $post)){
//            abort(403, 'not allow');
//        }

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
    public function edit(Post $post)
    {
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
    public function update(Post $post)
    {
        $user_id = auth()->user()->id;

        $post->update(array_merge(
            ['user_id' => $user_id],
            $this->validatePost(),
        ));

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
        $post->delete();

        return redirect('/posts/');
    }
}
