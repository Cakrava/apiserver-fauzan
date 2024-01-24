<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = "dosen2010054";
    protected $primaryKey = 'nidn2010054';
    protected $keyType = 'string';
    protected $fillable = [
        'nidn2010054',
        'namalengkap2010054',
        'jenkel2010054',
        'tmp_lahir2010054',
        'tgl_lahir2010054',
        'alamat2010054',
        'notelp2010054',
        'foto',
        'foto_thumb',


    ];
}
