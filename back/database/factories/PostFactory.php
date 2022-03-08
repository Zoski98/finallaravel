<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\Boolean;

class PostFactory extends Factory
{

    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(2,15),
            'post_title' => $this->faker->text(30),
            'post_content' => $this->faker->text(150),
            'image' => null,
            'section' => rand(1,3),
        ];
    }
}
