<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';
    protected $primaryKey = 'id_surat_keluar';

    protected $fillable = [
        'id_relasi',
        'id_bagian',
        'id_ruang_penyimpanan',
        'id_jenis_surat',
        'judul_surat_keluar',
        'nomor_surat_keluar',
        'lampiran',
        'perihal',
        'keterangan',
        'tanggal_surat_keluar',
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
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat');
    }

    public function relDisposisi()
    {
        return $this->hasOne(RelDisposisi::class, 'id_surat_keluar');
    }
}
