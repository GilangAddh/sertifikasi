<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'nama',
        'npm',
        'id_ps',
    ];

    public function krs()
    {
        return $this->hasMany(KRS::class, 'id_mahasiswa');
    }
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_ps');
    }
}
