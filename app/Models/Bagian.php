<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    use HasFactory;

    protected $table = 'bagian';
    protected $primaryKey = 'id_bagian';
    public $timestamps = false;

    public function relDisposisi()
    {
        return $this->hasMany(RelDisposisi::class, 'id_bagian', 'id_bagian');
    }
}
