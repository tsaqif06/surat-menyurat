<?php

namespace Database\Factories;

use App\Models\JenisSurat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JenisSurat>
 */
class JenisSuratFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = JenisSurat::class;

    public function definition()
    {
        return [
            'id_jenis_surat' => $this->faker->unique()->numberBetween(1, 100),
            'nama_jenis_surat' => $this->faker->word,
        ];
    }
}
