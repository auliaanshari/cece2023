<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\KategoriSoal;
use App\Models\LevelSoal;
use App\Models\StatusSoal;
use DataTables;

class SoalController extends Controller
{
    public function data(){
        $soal = Soal::with('kategori_soal', 'level_soal', 'status_soal');
        return DataTables::of($soal)->toJson();
    }

    public function pilihsoal($id){
        $soal = Soal::where('id', $id)->get();
        return $soal->toJson();
    }

    public function create(Request $request){
        $create = new Soal();
        $create->soal = $request->soal_input;
        $create->jawaban = $request->jawaban_input;
        $create->bobot = $request->bobot_input;
        $create->kategori_id = $request->kategori_input;
        $create->level_id = $request->level_input;
        $create->status_id = $request->status_input;
        $create->save();
    }

    public function update(Request $request, $id){
        $update = Soal::find($id);
        $update->soal = $request->soal_input;
        $update->jawaban = $request->jawaban_input;
        $update->bobot = $request->bobot_input;
        $update->kategori_id = $request->kategori_input;
        $update->level_id = $request->level_input;
        $update->status_id = $request->status_input;
        $update->save();
    }

    public function delete($id){
        Soal::where('id', $id)->delete();
    }
}
