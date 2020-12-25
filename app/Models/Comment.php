<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function replies() {
        return $this->hasMany('App\Models\Comment', 'reply_to')->where('approved',1);
    }


}
