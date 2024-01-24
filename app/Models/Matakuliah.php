<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = "matakuliah2010054";
    protected $primaryKey = 'kdmatkul2010054';
    protected $keyType = 'string';
    protected $fillable = [
        'kdmatkul2010054',
        'namamat2010054',
        'sks2010054',
        'foto',
        'foto_thumb',

    ];
}
