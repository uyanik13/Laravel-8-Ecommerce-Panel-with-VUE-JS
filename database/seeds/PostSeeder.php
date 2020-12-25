<?php

use Carbon\Carbon;
use Faker\Factory;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $path =  base_path().'/resources/views/pages';
        $files = File::allFiles($path);


        foreach ($files as $key => $value) {
            $fileName = substr($value->getFileName(),0,-10);
            Post::create(
                [
                'title' =>
                        [
                            "en" =>  $fileName,
                            "tr" =>  $fileName,
                            "de" =>  $fileName,
                        ],

                'content' =>
                        [
                            "en" =>  'en-'.$fileName,
                            "tr" =>  'tr-'.$fileName,
                            "de" =>  'de-'.$fileName,
                        ],
               'seo_title' =>
                        [
                            "en" =>  'en-'.$fileName . ' SEO TITLE',
                            "tr" =>  'tr-'.$fileName . ' SEO TITLE',
                            "de" =>  'de-'.$fileName . ' SEO TITLE',
                        ],
               'seo_description' =>
                        [
                            "en" =>  'en-'.$fileName . ' SEO DESCRIPTION',
                            "tr" =>  'tr-'.$fileName . ' SEO DESCRIPTION',
                            "de" =>  'de-'.$fileName . ' SEO DESCRIPTION',
                        ],
                'status' => 1,
                'type' => 'page',
                'user_id' => User::where('role','admin')->first()->id,
                'created_at' => Carbon::now(),
           ]

       );
  }



       // Post::factory(10)->create();
        //factory(Post::class, 100)->create();
    }
}
