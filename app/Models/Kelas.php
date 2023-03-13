<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasOne(User::class, 'id_user');

    }
}
