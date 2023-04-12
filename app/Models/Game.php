<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = "games";

    protected $fillable = [
        'id',
        'ronde_id'
    ];

    public function detail_game(){
        return $this->hasMany(DetailGame::class);
    }

    public function soal(){
        return $this->hasMany(DetailGame::class);
    }

    public function ronde(){
        return $this->belongsTo(Ronde::class, 'ronde_id');
    }
}
