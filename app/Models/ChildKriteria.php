<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildKriteria extends Model
{
    protected $table = "child_kriterias";
    protected $primaryKey = 'id';

    protected $fillable = ['kode_kriteria', 'jawaban', 'skor'];

    public function kriteria()
    {
        return $this->hasMany(Kriteria::class, 'kode_kriteria', 'kode');
    }
}
