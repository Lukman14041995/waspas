<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueKriteria extends Model
{
    protected $table = "value_kriterias";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'kode_kriteria',
        'kode_alternatif',
        'jawaban',
        'skor',
    ];

    public function kriteria()
    {
        return $this->hasMany(Kriteria::class, 'kode_kriteria', 'kode');
    }
}
