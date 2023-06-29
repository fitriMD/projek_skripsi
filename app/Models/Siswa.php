<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Alternatif;

class Siswa extends Model
{
    use HasFactory;

    protected $table = "data_siswa";
    public $timestamps = false;
    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'nis',
        'nama',
        'gender',
        'id_kelas_siswa',
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'id_kelas_siswa');

    }
    public function alternatif(){
        return $this->belongsTo(Alternatif::class);

    }
    public function periode(){
        return $this->belongsTo(Periode::class,'id_periode');

    }

}
