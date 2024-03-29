<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $table = "periode";
    public $timestamps = false;
    protected $primaryKey = 'id_periode';

    protected $fillable = [
        'nama_periode',
        'status',
        'created_at'

    ];
    
    public function siswa(){
        return $this->hasMany(Siswa::class);

    }
}
