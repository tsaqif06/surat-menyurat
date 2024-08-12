<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';
    protected $primaryKey = 'id_surat_masuk';
    public $timestamps = false;

    public function relDisposisi()
    {
        return $this->hasMany(RelDisposisi::class, 'id_surat_masuk', 'id_surat_masuk');
    }
}
