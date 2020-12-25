<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory,HasTranslatableSlug,HasTranslations;

    protected $guarded = [];

    public $translatable = ['title','slug','seo_title','seo_description'];



    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::createWithLocales(config('app.locales'))
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function specificResourcePath()
    {
        return 'admin/categories/' . $this->id;
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
}
