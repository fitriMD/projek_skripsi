<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topsis extends Model
{
    use HasFactory;

    protected $table = "topsis";
    public $timestamps = false;
    protected $primaryKey = 'id_topsis';

    protected $fillable = [
        'id_periode',
        'matrix_penilaian',
        'normalisasi',
        'normalisasi_terbobot',
        'solusi_ideal_positif_negatif',
        'jarak_relatif',
    ];

    public function periode(){
        return $this->belongsTo(Periode::class, 'id_periode');

    }
}
