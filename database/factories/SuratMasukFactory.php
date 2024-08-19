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
            // 'id_surat_masuk' => $this->faker->unique()->numberBetween(1, 10000),
            'id_relasi' => Relasi::factory(),
            'id_bagian' => Bagian::factory(),
            'id_ruang_penyimpanan' => RuangPenyimpanan::factory(),
            'id_jenis_surat_masuk' => JenisSurat::factory(),
            'judul_surat_masuk' => $this->faker->text(50),
            'nomor_surat_masuk' => $this->faker->unique()->numerify('SURAT-###'),
            'lampiran' => $this->faker->text(10),
            'perihal' => $this->faker->text(100),
            'keterangan' => $this->faker->text(200), // Sesuaikan panjangnya
            'tanggal_surat_masuk' => $this->faker->date,
            'file_surat' => $this->faker->text(500),
            'status_surat' => $this->faker->numberBetween(0, 10),
            'tanggal_update' => $this->faker->dateTime,
            'update_by' => $this->faker->text(50),
            'tanggal_disposisi' => $this->faker->date,
            'tindaklanjut_disposisi' => $this->faker->text(100),
            'ket_disposisi' => $this->faker->text(200), // Sesuaikan panjangnya
            'nama_ruang' => $this->faker->text(100),
            'no_almari' => $this->faker->text(20),
        ];
    }
}
