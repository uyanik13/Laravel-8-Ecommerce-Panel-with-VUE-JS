<?php

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['product','post','service','portfolio'];

        foreach ($categories as $key => $category) {
            Category::create(
                [
               'title' =>
                        [
                            "en" =>  $category,
                            "tr" =>  $category,
                            "de" =>  $category,
                        ],
               'seo_title' =>
                        [
                            "en" =>  'en-'.$category . ' SEO TITLE',
                            "tr" =>  'tr-'.$category . ' SEO TITLE',
                            "de" =>  'de-'.$category . ' SEO TITLE',
                        ],
               'seo_description' =>
                        [
                            "en" =>  'en-'.$category . ' SEO DESCRIPTION',
                            "tr" =>  'tr-'.$category . ' SEO DESCRIPTION',
                            "de" =>  'de-'.$category . ' SEO DESCRIPTION',
                        ],
               'created_at' => Carbon::now(),
           ]);
        }
  }


}
