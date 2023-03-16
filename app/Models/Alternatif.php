<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = "data_alternatif";
    public $timestamps = false;
    protected $primaryKey = 'id_alternatif';

    protected $fillable = [
        'id_siswa',
        'C1',
        'C2',
        'C3',
        'C4',
        'C5',
        'C6',

    ];

    public function siswa(){
        return $this->hasMany(Siswa::class, 'id_siswa');

    }
}
