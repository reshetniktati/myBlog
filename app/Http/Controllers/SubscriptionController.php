<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeToAuthor;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.subscribe', [
            'email' => auth()->user()->email,
            'post' => $post,
        ]);
    }

    public function store(Post $post) {
        request()->validate([
            'email' => ['required', 'email'],
        ]);

        $subscriptions = in_array($post->user->id, Subscription::all()->pluck('subscription_user_id')->toArray());

        if ($subscriptions) {
            return redirect(route('subscribe.index', ['post'=>$post]))->with('message', 'You\'ve already been subscribed to this author');
        }
        Subscription::create(
            [
                'user_id' => auth()->user()->id,
                'subscription_user_id' => $post->user->id,
            ]
        );

        Subscriber::create(
            [
                'user_id' => $post->user->id,
                'subscriber_user_id' => auth()->user()->id,
            ]
        );

        Mail::to(request('email'))->send(new SubscribeToAuthor($post->user->name, auth()->user()->name));

        return redirect(route('subscribe.index', ['post'=>$post]))->with('message', 'Email sent!');
    }
}
