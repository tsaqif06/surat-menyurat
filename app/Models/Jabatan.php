<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatans';

    protected $primaryKey = 'id_jabatan';

    public $timestamps = false;

    protected $fillable = [
        'nama_jabatan',
    ];

    // public function users()
    // {
    //     return $this->hasMany(User::class, 'id_jabatan', 'id_jabatan');
    // }
}
