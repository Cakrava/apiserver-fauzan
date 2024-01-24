<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = "mahasiswa_2010054";
    protected $primaryKey = 'nim_2010054';
    protected $keyType = 'string';
    protected $fillable = [
        'nim_2010054',
        'nama_lengkap_2010054',
        'jenis_kelamin_2010054',
        'tmp_lahir_2010054',
        'tgl_lahir_2010054',
        'alamat_2010054',
        'notelp_2010054',
        'foto',
        'foto_thumb',

    ];

}
