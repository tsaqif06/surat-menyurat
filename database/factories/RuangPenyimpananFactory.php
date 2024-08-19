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
            // 'id_ruang_penyimpanan' => $this->faker->unique()->numberBetween(1, 10000),
            'nama_ruang' => $this->faker->word,
        ];
    }
}
