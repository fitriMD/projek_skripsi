<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = "data_kriteria";
    public $timestamps = false;
    protected $primaryKey = 'id_kriteria';

    protected $fillable = [
        'nm_kriteria',
        'variabel',
        'tipe',

    ];
}
