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
            'nama_jabatan' => substr($this->faker->jobTitle, 0, 50),
        ];
    }
}
