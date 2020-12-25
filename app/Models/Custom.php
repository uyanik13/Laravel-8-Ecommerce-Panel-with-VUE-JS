<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    protected $guarded = [];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }
}
