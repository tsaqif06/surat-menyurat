<?php

namespace Database\Factories;

use App\Models\Bagian;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\RelDisposisi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RelDisposisi>
 */
class RelDisposisiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = RelDisposisi::class;

    public function definition()
    {
        return [
            // 'id_disposisi' => $this->faker->unique()->numberBetween(1, 10000),
            'id_bagian' => Bagian::factory(),
            'id_surat_masuk' => SuratMasuk::factory(),
            'id_surat_keluar' => SuratKeluar::factory(),
            'status_disposisi' => $this->faker->randomDigit,
        ];
    }
}
