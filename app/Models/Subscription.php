<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    protected $table = 'users_subscriptions';
    public $timestamps = false;

    protected $fillable = ['user_id', 'subscription_user_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
