<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'detail_krs';
    public $timestamps = false;

    protected $fillable = [
        'id_krs',
        'id_mata_kuliah',
        'keterangan',
    ];

    public function krs()
    {
        return $this->belongsTo(KRS::class, 'id_krs');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mata_kuliah');
    }
}
