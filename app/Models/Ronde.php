<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ronde extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "rondes";

    protected $fillable = [
        'id', 
        'ronde'
    ];

    public function game(){
        return $this->hasMany(Game::class);
    }
}
