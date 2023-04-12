<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->string('soal', 300);
            $table->string('jawaban', 50);
            $table->integer('bobot');
            $table->foreignId('kategori_id')->constrained('kategori_soals');
            $table->foreignId('level_id')->constrained('level_soals');
            $table->foreignId('status_id')->constrained('status_soals');
            $table->foreignId('game_id')->constrained('games');
            $table->integer('urutan');
            $table->foreignId('team_id')->constrained('teams');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soals');
    }
}
