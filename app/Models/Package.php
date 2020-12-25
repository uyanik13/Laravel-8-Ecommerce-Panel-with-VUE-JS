<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Package extends Model
{
    use HasTranslations;

  protected $guarded = [];

  public $translatable = ['title', 'second_title', 'description','thumbnail'];



}
