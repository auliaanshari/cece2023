<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "soals";

    protected $fillable = [
        'id', 
        'soal',
        'jawaban',
        'bobot',
        'kategori_id',
        'level_id',
        'status_id',
        'game_id',
        'urutan',
        'team_id'
    ];

    public function kategori_soal(){
        return $this->belongsTo(KategoriSoal::class, 'kategori_id');
    }

    public function level_soal(){
        return $this->belongsTo(LevelSoal::class, 'level_id');
    }

    public function status_soal(){
        return $this->belongsTo(StatusSoal::class, 'status_id');
    }

    public function team(){
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function game(){
        return $this->belongsTo(Game::class, 'game_id');
    }
}
