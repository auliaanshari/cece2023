<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailGame;
use App\Models\Game;
use App\Models\Team;
use App\Models\Soal;
use DB;
use DataTables;


class DetailGameController extends Controller
{
    public function data(){
        $detail_game = DetailGame::with( 'team', 'game', 'game.ronde')->get();
        dd($detail_game);
        return $detail_game->toJson();
    }

    public function create(Request $request){
        $create = new DetailGame();
        $create->game_id = $request->game_input;
        $create->team_id = $request->teamA_input;
        $create->nilai = 0;
        $create->bonus = 0;
        $create->total = 0;
        $create->save();
        $create1 = new DetailGame();
        $create1->game_id = $request->game_input;
        $create1->team_id = $request->teamB_input;
        $create1->nilai = 0;
        $create1->bonus = 0;
        $create1->total = 0;
        $create1->save();
        $create2 = new DetailGame();
        $create2->game_id = $request->game_input;
        $create2->team_id = $request->teamC_input;
        $create2->nilai = 0;
        $create2->bonus = 0;
        $create2->total = 0;
        $create2->save();
        $create3 = new DetailGame();
        $create3->game_id = $request->game_input;
        $create3->team_id = 999;
        $create3->nilai = 0;
        $create3->bonus = 0;
        $create3->total = 0;
        $create3->save();
    }

    public function main($id){
        $gamesoal = Soal::where('game_id', $id)->first();
        if($gamesoal){
            $soal = Soal::where('game_id', $id)->orderBy('urutan','asc')->get();            
        }
        else{
            $soal = Soal::inRandomOrder()->where('status_id', 1)->where('game_id',NULL)->limit('25')->get();
            $urut = 1;
            foreach($soal as $soals){
                $soals->update(['game_id' => $id]);
                $soals->update(['urutan' => $urut++]);
            }
            $soal = Soal::where('game_id', $id)->orderBy('urutan','asc')->get();
        }
        $game = $id;
        $team = DetailGame::where('game_id', $game)->get();
        $no = 1;
        foreach($team as $t){
            ${'tim'.$no++} = $t->team_id;
        }

        $score = Soal::select('game_id', 'team_id', DB::raw('SUM(bobot) as nilai'))
        ->where('game_id', $game)
        ->whereNotNull('team_id')
        ->groupBy('team_id', 'game_id')->get();

        $nu = 1;
        foreach($score as $sc){
            DetailGame::where('game_id', $game)->where('team_id', $sc->team_id)
            ->update(['nilai' => $sc->nilai]);
        }

        $total = DetailGame::where('game_id',$game)->get();

        $nu = 1;
        foreach($total as $tot){
            DetailGame::where('game_id', $game)->where('team_id', $tot->team_id)
            ->update(['total' => $tot->nilai+$tot->bonus]);
        }

        $scores = DetailGame::select('game_id', 'team_id', 'teams.nama_team', 'nilai', 'bonus', 'total')
        ->join('teams','teams.id', '=','detail_games.team_id')
        ->where('game_id', $game)
        ->whereNotNull('team_id')
        ->groupBy('team_id', 'teams.nama_team','game_id', 'nilai', 'bonus', 'total',)->get();
        
        $ronde = Game::select('games.id','rondes.ronde')
        ->join('rondes','rondes.id', '=','games.ronde_id')
        ->where('games.id',$game)->first();

        return view('play.main', compact(['scores','soal','tim1', 'tim2', 'tim3', 'tim4', 'game','ronde']));
    }

    public function update(Request $request, $id){
        $update = DetailGame::find($id);
        $update->game_ke = $request->game_input;
        $update->babak_id = $request->babak_input;
        $update->save();
    }

    public function delete($id){
        DetailGame::where('id', $id)->delete();
    }

    public function benar(Request $request){
        $gameid = $request->game_input;
        $teamid = $request->team_input;
        $soalid = $request->soal_input;
        $benar = Soal::where('id', $soalid)->where('game_id', $gameid)->first();
        $benar->update(['team_id' => $teamid]);
        $benar->update(['status_id' => 2]);

    }

    public function bonus(Request $request, $id){
        $gameid = $request->game_input;
        $teamid = $request->team_input;
        $bonus = $request->bonus_input;
        
        $bonus = DetailGame::where('game_id', $gameid)->where('team_id', $teamid)
        ->update(['bonus' => $bonus]);

    }
}
