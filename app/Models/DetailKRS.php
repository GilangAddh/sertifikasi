<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKRS extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode',
        'mata_ajar',
        'sks',
    ];

    public function detailKRS()
    {
        return $this->hasMany(DetailKRS::class, 'id_mata_kuliah');
    }
}
