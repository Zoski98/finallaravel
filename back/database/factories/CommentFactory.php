<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */



    protected $model = Comment::class;
    public function definition()
    {

        return [
            
            
            'user_id' => rand(2, 15),
            'post_id' => rand(1, 30),
            'reply_content' => $this->faker->text(65),
            'files' => null,
        ];
    }
}
