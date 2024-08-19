<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    use HasFactory;

    protected $table = 'bagians';
    protected $primaryKey = 'id_bagian';
    public $timestamps = false;

    protected $fillable = [
        'nama_bagian',
    ];

    public function suratMasuk()
    {
        return $this->hasMany(SuratMasuk::class, 'id_bagian');
    }

    public function suratKeluar()
    {
        return $this->hasMany(SuratKeluar::class, 'id_bagian');
    }
}
