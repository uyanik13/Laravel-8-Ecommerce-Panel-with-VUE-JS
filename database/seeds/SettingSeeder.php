<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts =
            [
                [
                    'id' => 1,
                    'type' => 'site-setting',
                    'name' => 'logo',
                    'value' => 'https://www.dijitalreklam.org/wp-content/uploads/2019/03/LOGO1-dijitalreklam12.png',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 2,
                    'type' => 'site-setting',
                    'name' => 'facebook',
                    'value' => 'https://www.facebook.com',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 3,
                    'type' => 'site-setting',
                    'name' => 'instagram',
                    'value' => 'https://www.instagram.com',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 4,
                    'type' => 'site-setting',
                    'name' => 'linkedin',
                    'value' => 'https://www.linkedin.com',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],

                [
                    'id' => 5,
                    'type' => 'site-setting',
                    'name' => 'twitter',
                    'value' => 'https://www.twitter.com',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 6,
                    'type' => 'site-setting',
                    'name' => 'google',
                    'value' => 'https://www.google.com',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 7,
                    'type' => 'site-setting',
                    'name' => 'pinterest',
                    'value' => 'https://www.pinterest.com',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 8,
                    'type' => 'site-setting',
                    'name' => 'address',
                    'value' => 'Your Address',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 9,
                    'type' => 'site-setting',
                    'name' => 'phone',
                    'value' => 'Your Phone',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 10,
                    'type' => 'site-setting',
                    'name' => 'email',
                    'value' => 'Your Email',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 11,
                    'type' => 'site-setting',
                    'name' => 'site_url',
                    'value' => 'Your Site URL',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 12,
                    'type' => 'site-setting',
                    'name' => 'map_iframe',
                    'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d385395.5590093091!2d28.7319848019259!3d41.0055005188885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa7040068086b%3A0xe1ccfe98bc01b0d0!2zxLBzdGFuYnVs!5e0!3m2!1str!2str!4v1599724937402!5m2!1str!2str" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 13,
                    'type' => 'site-setting',
                    'name' => 'site_name',
                    'value' => 'Your Site Title',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 14,
                    'type' => 'site-setting',
                    'name' => 'site_video',
                    'value' => 'Your Site Video Intro',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 15,
                    'type' => 'site-setting',
                    'name' => 'youtube',
                    'value' => 'https://www.youtube.com',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 16,
                    'type' => 'site-setting',
                    'name' => 'currency',
                    'value' => 'USD',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 17,
                    'type' => 'site-setting',
                    'name' => 'white_logo',
                    'value' => 'http://via.placeholder.com/180x45',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 18,
                    'type' => 'site-setting',
                    'name' => 'transparent_logo',
                    'value' => 'http://via.placeholder.com/180x45',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 19,
                    'type' => 'site-setting',
                    'name' => 'mobile_logo',
                    'value' => 'http://via.placeholder.com/180x45',
                    'form_type' => 'setting',
                    'created_at' => Carbon::now(),
                ],


            ];


        Setting::insert($posts);

    }
}
