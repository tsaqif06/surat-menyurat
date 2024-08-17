<?php

namespace Database\Factories;

use App\Models\Jabatan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jabatan>
 */
class JabatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Jabatan::class;
    public function definition()
    {
        return [
            'id_jabatan' => $this->faker->unique()->numberBetween(1, 100),
            'nama_jabatan' => $this->faker->jobTitle,
        ];
    }
}
