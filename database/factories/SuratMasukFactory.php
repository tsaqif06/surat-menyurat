<?php

namespace Database\Factories;

use App\Models\Bagian;
use App\Models\Relasi;
use App\Models\JenisSurat;
use App\Models\SuratMasuk;
use App\Models\RuangPenyimpanan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratMasuk>
 */
class SuratMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SuratMasuk::class;

    public function definition()
    {
        return [
            'id_surat_masuk' => $this->faker->unique()->numberBetween(1, 100),
            'id_relasi' => Relasi::factory(),
            'id_bagian' => Bagian::factory(),
            'id_ruang_penyimpanan' => RuangPenyimpanan::factory(),
            'id_jenis_surat_masuk' => JenisSurat::factory(),
            'judul_surat_masuk' => $this->faker->sentence,
            'nomor_surat_masuk' => $this->faker->unique()->numerify('SURAT-###'),
            'lampiran' => $this->faker->word,
            'perihal' => $this->faker->sentence,
            'keterangan' => $this->faker->paragraph,
            'tanggal_surat_masuk' => $this->faker->date,
            'file_surat' => $this->faker->fileExtension,
            'status_surat' => $this->faker->randomDigit,
            'tanggal_update' => $this->faker->dateTime,
            'update_by' => $this->faker->name,
            'tanggal_disposisi' => $this->faker->date,
            'tindaklanjut_disposisi' => $this->faker->sentence,
            'ket_disposisi' => $this->faker->paragraph,
            'nama_ruang' => $this->faker->word,
            'no_almari' => $this->faker->word,
        ];
    }
}
