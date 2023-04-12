<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use DataTables;

class TeamController extends Controller
{
    public function data(){
        $team = Team::all();
        return DataTables::of($team)->toJson();
    }

    public function create(Request $request){
        $create = new Team();
        $create->nama_team = $request->team_input;
        $create->asal_masjid = $request->asal_input;
        $create->save();
    }

    public function update(Request $request, $id){
        $update = Team::find($id);
        $update->nama_team = $request->team_input;
        $update->asal_masjid = $request->asal_input;
        $update->save();
    }

    public function delete($id){
        Team::where('id', $id)->delete();
    }

    public function combo_team()
    {
        $team = Team::select("*")->orderBy('id', 'desc')->get();
        return $team->toJson();
    }
}
