<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subscription extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function users()
  {
    return $this->belongsTo(User::Class);
  }

}

