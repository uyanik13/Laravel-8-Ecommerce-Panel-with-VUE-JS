<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

            return [
                'id' => '3387f290-dc98-11ea-af1b-17b4141fee92',
                'name' => 'Ogur',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'address' => 'inkilap',
                'email_verified_at' => Carbon::now(),
                'phone' => '905456134513',
                'cv' => '/images/uploads/3387f290-dc98-11ea-af1b-17b4141fee92/3bdd36ad1cb4b87cfd2a5202c61ed7ff-ogur.pdf',
                'social_data' => '{"twitter":"twitter","facebook":"facebook","instagram":"instagram","github":"github","linkedin":"linkedin","youtube":"youtube","slack":"slack"}',
                'about_data' => '{"bio":"afasfasfasf","dob":"11 August 2020","country":{"label":"Australia","value":"australia"},"lang_known":[{"label":"Spanish","value":"spanish"},{"label":"French","value":"french"}],"website":"dro","gender":"male"}',
                'user_data' => '{"EduData":[{"school":"adana","year":"asfafafsa"},{"year":"2018","school":"istanbul"}],"type":"EduData"}',
                'notification_data' => '{"comment":false,"answer":false,"follow":false,"news":true,"product_update":true,"blog":true}',
                'role' => 'admin'
            ];

    }
}
