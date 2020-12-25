<?php

use Illuminate\Database\Seeder;
use App\Models\Vote;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Vote::class, 1000)->create();
    }
}
