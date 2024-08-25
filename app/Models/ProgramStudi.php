<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'program_studi';

    protected $fillable = ['nama'];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_ps');
    }
}
