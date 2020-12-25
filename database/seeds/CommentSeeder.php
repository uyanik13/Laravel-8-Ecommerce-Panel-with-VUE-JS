<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;
use Faker\Factory;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Comment::class, 1000)->create();
    }
}
