<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'admin',
            'email' => 'admin@glitterups.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'), // password
            'remember_token' => Str::random(10),
            
        ];
    }
}
