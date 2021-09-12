<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{

    protected $table = 'users_subscribers';
    public $timestamps = false;

    protected $fillable = ['user_id', 'subscriber_user_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
