<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = "anggotas";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'kode_alternatif',
        'no_sk',
        'nama_anggota',
        'luas_tanah',
    ];

    public function decision_matrix()
    {
        return $this->hasMany(DecisionMatrix::class, 'id_alternatif', 'id');
    }

    public function isUsed()
    {
        // Pemeriksaan apakah id_alternatif telah digunakan di tabel decision_matrix
        return DecisionMatrix::where('id_alternatif', $this->id)->exists();
    }
}
