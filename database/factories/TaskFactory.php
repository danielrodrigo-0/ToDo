<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::all()->random();
        $user = $category->user;

        return [
            //
            'is_done'=>fake()->boolean(),
            'title'=>fake()->text(20),
            'description'=>fake()->text(60),
            'due_date'=>fake()->dateTime(),
            'user_id'=>$user,
            'category_id'=>$category
        ];
    }
}
