<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Kelas extends Model
{
    use HasFactory;

    protected $table = "data_kelas";
    public $timestamps = false;
    protected $primaryKey = 'id_kelas';

    protected $fillable = [
        'nama_kelas',
        'id_user_walikelas',
    ];

    public function waliKelas(){
        return $this->belongsTo(User::class, 'id_user_walikelas');

    }

    public function siswa(){
        return $this->hasMany(Siswa::class);

    }

}
