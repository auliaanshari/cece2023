<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Game;
Use App\Models\Ronde;
use DataTables;

class GameController extends Controller
{
    public function data(){
        $game = Game::with('ronde');
        return DataTables::of($game)->toJson();
    }

    public function create(Request $request){
        $create = new Game();
        $create->game_ke = $request->game_input;
        $create->ronde_id = $request->ronde_input;
        $create->save();
    }

    public function update(Request $request, $id){
        $update = Game::find($id);
        $update->game_ke = $request->game_input;
        $update->ronde_id = $request->ronde_input;
        $update->save();
    }

    public function delete($id){
        Game::where('id', $id)->delete();
    }

    public function combo_game()
    {
        $game = Game::select("*")->with('ronde')->orderBy('game_ke','desc')->get();
        return $game->toJson();
    }
}
