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

//    public function users()
//     {
//         return $this->hasMany(User::class, 'id_bagian', 'id_bagian');
//     }
}
