<?php

namespace Database\Factories;

use App\Models\Relasi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Relasi>
 */
class RelasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Relasi::class;

    public function definition()
    {
        return [
            // 'id_relasi' => $this->faker->unique()->numberBetween(1, 10000),
            'nama_relasi' => $this->faker->company,
        ];
    }
}
