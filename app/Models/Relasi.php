<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relasi extends Model
{
    use HasFactory;

    protected $table = 'relasis';
    protected $primaryKey = 'id_relasi';
    public $timestamps = false;

    protected $fillable = [
        'id_relasi',
        'nama_relasi',
    ];
}
