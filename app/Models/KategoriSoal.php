<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSoal extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "kategori_soals";

    protected $fillable = [
        'id', 
        'kategori_soal'
    ];

    public function soal(){
        return $this->hasMany(Soal::class);
    }
}
