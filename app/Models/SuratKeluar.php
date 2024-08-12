<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';
    protected $primaryKey = 'id_surat_keluar';
    public $timestamps = false;

    public function relDisposisi()
    {
        return $this->hasMany(RelDisposisi::class, 'id_surat_keluar', 'id_surat_keluar');
    }
}
