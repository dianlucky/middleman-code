<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = User::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName,
            'password' => bcrypt('password'),
            'role' => $this->faker->randomElement(['superadmin', 'admin', 'member']),
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'birth_date' => $this->faker->date(),
            'profile_pic' => 'def-profile.png',
            'address' => $this->faker->address,
        ];
    }
}
