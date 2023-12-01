<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->userName,
            'status' => 'Available',
            'contact_phone' => $this->faker->numberBetween(10000000000000, 99999999999999),
            'whatsapp_phone' => $this->faker->numberBetween(10000000000000, 99999999999999),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'birthday' => $this->faker->date,
            'address' => $this->faker->address,
            'profession' => $this->faker->word,
            'shop_name' => $this->faker->company,
            'provider_id' => null,
            'avatar' => null,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'is_fake' => true,
        ];
    }
}
