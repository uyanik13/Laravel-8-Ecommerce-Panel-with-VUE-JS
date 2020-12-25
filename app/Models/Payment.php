<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $guarded = [];
  protected $with = ['user'];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }
}
