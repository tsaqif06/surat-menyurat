<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangPenyimpanan extends Model
{
    use HasFactory;

    protected $table = 'ruang_penyimpanans';
    protected $primaryKey = 'id_ruang_penyimpanan';
    public $timestamps = false;

    protected $fillable = [
        'nama_ruang',
    ];

    public function suratMasuk()
    {
        return $this->hasMany(SuratMasuk::class, 'id_ruang_penyimpanan');
    }

    public function suratKeluar()
    {
        return $this->hasMany(SuratKeluar::class, 'id_ruang_penyimpanan');
    }
}
