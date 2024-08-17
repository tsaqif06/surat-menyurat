<?php

namespace Database\Factories;

use App\Models\Bagian;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bagian>
 */
class BagianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Bagian::class;

    public function definition()
    {
        return [
            'id_bagian' => $this->faker->unique()->numberBetween(1, 100),
            'nama_bagian' => $this->faker->word,
        ];
    }
}
