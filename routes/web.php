<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\DetailGameController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'play'], function(){
    Route::get('/', function() { return view('play.regist'); });
    Route::get('/main/{id}', [DetailGameController::class, 'main']);
    Route::get('/finish', function() { return view('play.finish'); });
    Route::get('/tanding', function() { return view('play.tanding'); });
    Route::post('/create', [DetailGameController::class, 'create']);
    Route::post('/update/{id}', [DetailGameController::class, 'update']);
    Route::get('/delete/{id}', [DetailGameController::class, 'delete']);
    Route::get('/data', [DetailGameController::class, 'data']);
    Route::post('/benar', [DetailGameController::class, 'benar']);
    Route::post('/bonus/{id}', [DetailGameController::class, 'bonus']);
});

Route::group(['prefix' => 'soal'], function(){
    Route::get('/', function() { return view('soal.soal'); });
    Route::post('/create', [SoalController::class, 'create']);
    Route::post('/update/{id}', [SoalController::class, 'update']);
    Route::get('/delete/{id}', [SoalController::class, 'delete']);
    Route::get('/data', [SoalController::class, 'data']);
    Route::get('/pilihsoal/{id}', [SoalController::class, 'pilihsoal']);
});

Route::group(['prefix' => 'team'], function(){
    Route::get('/', function() { return view('team.team'); });
    Route::post('/create', [TeamController::class, 'create']);
    Route::post('/update/{id}', [TeamController::class, 'update']);
    Route::get('/delete/{id}', [TeamController::class, 'delete']);
    Route::get('/data', [TeamController::class, 'data']);
    Route::get('/combo_team', [TeamController::class, 'combo_team']);
});

Route::group(['prefix' => 'game'], function(){
    Route::get('/', function() { return view('game.game'); });
    Route::post('/create', [GameController::class, 'create']);
    Route::post('/update/{id}', [GameController::class, 'update']);
    Route::get('/delete/{id}', [GameController::class, 'delete']);
    Route::get('/data', [GameController::class, 'data']);
    Route::get('/combo_game', [GameController::class, 'combo_game']);
});