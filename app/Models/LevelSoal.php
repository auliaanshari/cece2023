<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelSoal extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "level_soals";

    protected $fillable = [
        'id', 
        'level_soal'
    ];

    public function soal(){
        return $this->hasMany(Soal::class);
    }
}
