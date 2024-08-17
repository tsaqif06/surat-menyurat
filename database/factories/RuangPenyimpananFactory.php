<?php

namespace Database\Factories;

use App\Models\RuangPenyimpanan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RuangPenyimpanan>
 */
class RuangPenyimpananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = RuangPenyimpanan::class;

    public function definition()
    {
        return [
            'id_ruang' => $this->faker->unique()->numberBetween(1, 100),
            'nama_ruang' => $this->faker->word,
        ];
    }
}
