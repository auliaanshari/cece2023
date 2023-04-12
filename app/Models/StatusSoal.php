<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusSoal extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "status_soals";

    protected $fillable = [
        'id', 
        'status_soal'
    ];

    public function soal(){
        return $this->hasMany(Soal::class);
    }
}
