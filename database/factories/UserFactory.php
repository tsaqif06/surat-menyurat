<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = User::class;
    public function definition()
    {
        return [
            'id_user' => $this->faker->unique()->numberBetween(1, 100),
            'id_jabatan' => Jabatan::factory(),
            'nama_user' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'password' => 'password123', // atau gunakan hashed password lainnya
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
