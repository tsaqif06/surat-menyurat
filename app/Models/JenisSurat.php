<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;

    protected $table = 'jenis_surats';
    protected $primaryKey = 'id_jenis_surat';
    public $timestamps = false;

    protected $fillable = [
        'nama_jenis_surat',
    ];

    public function suratMasuk()
    {
        return $this->hasMany(SuratMasuk::class, 'id_jenis_surat_masuk');
    }

    public function suratKeluar()
    {
        return $this->hasMany(SuratKeluar::class, 'id_jenis_surat');
    }
}
