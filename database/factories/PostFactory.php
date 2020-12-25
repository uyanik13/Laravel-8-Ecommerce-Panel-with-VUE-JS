<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->sentence(10),
            'user_id' => User::all()->random(),
            'category_id' => 1,
            'seo_title' => $this->faker->sentence(4),
            'seo_description' => $this->faker->sentence(6),
            'slug'=> 'product-'.rand(1,100),
            'options' => '{"features":[{"key":null,"value":null}],"gallery":["\/uploads\/4e053c20-f918-11ea-8613-d155a43bec68\/d97ccd67a128de145d83714425d20b32-ogur.webp","\/uploads\/4e053c20-f918-11ea-8613-d155a43bec68\/d97ccd67a128de145d83714425d20b32-ogur.jpeg"]}',
            'price'=>rand(0, 500),
            'discounted_price'=>rand(0,400),
            'quantity'=>rand(0,500),
            'type' => 'product',
            'status' => rand(0, 1),
            'thumbnail' => 'https://via.placeholder.com/500.png',
            'created_at' => $this->faker->dateTime($max = 'now', $timezone = null)
        ];
    }
}
