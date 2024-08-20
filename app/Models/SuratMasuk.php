<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuks';
    public $timestamps = false;
    protected $primaryKey = 'id_surat_masuk';
    protected $fillable = [
        'id_relasi',
        'id_bagian',
        'id_ruang_penyimpanan',
        'id_jenis_surat_masuk',
        'judul_surat_masuk',
        'nomor_surat_masuk',
        'lampiran',
        'perihal',
        'keterangan',
        'tanggal_surat_masuk',
        'file_surat',
        'status_surat',
        'tanggal_update',
        'update_by',
        'tanggal_disposisi',
        'tindaklanjut_disposisi',
        'ket_disposisi',
        'nama_ruang',
        'no_almari',
    ];

    public function relasi()
    {
        return $this->belongsTo(Relasi::class, 'id_relasi');
    }

    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'id_bagian');
    }

    public function ruangPenyimpanan()
    {
        return $this->belongsTo(RuangPenyimpanan::class, 'id_ruang_penyimpanan');
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat_masuk');
    }

    public function relDisposisi()
    {
        return $this->hasOne(RelDisposisi::class, 'id_surat_masuk');
    }
}
