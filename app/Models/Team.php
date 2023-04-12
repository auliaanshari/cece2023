<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = "teams";

    protected $fillable = [
        'id', 
        'nama_team',
        'asal_masjid'
    ];

    public function detail_game(){
        return $this->hasMany(DetailGame::class);
    }

    public function soal(){
        return $this->hasMany(Soal::class);
    }
}
