<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelDisposisi extends Model
{
    use HasFactory;

    protected $table = 'rel_disposisis';
    public $timestamps = false;

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'id_surat_masuk', 'id_surat_masuk');
    }

    public function suratKeluar()
    {
        return $this->belongsTo(SuratKeluar::class, 'id_surat_keluar', 'id_surat_keluar');
    }

    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'id_bagian', 'id_bagian');
    }
}
