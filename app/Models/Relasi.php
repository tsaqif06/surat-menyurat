<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relasi extends Model
{
    use HasFactory;

    protected $table = 'relasi';
    protected $primaryKey = 'id_relasi';

    protected $fillable = [
        'id_relasi',
        'nama_relasi',
    ];

    public function suratMasuk()
    {
        return $this->hasMany(SuratMasuk::class, 'id_relasi');
    }

    public function suratKeluar()
    {
        return $this->hasMany(SuratKeluar::class, 'id_relasi');
    }
}
