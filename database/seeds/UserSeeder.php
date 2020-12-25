<?php

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::factory()->create();



    }
}
