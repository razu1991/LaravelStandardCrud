<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'title' => 'User [' . $user->name . '] info updated Successfully',
            'details' => 'User [' . $user->name . '] info updated. This user updated# ' . $user->created_at->diffForHumans()
        ];
    }
}
