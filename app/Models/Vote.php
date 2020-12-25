<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ['allowed_to_vote_from'];

    public function post()
    {
        return $this->belognsTo('App\Models\Post');
    }

    public function user()
    {
        return $this->belognsTo('App\Models\User');
    }

}
