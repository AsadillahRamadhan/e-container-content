<?php

namespace App\Http\Controllers;

use App\Models\LoadingDock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoadingDockController extends Controller
{
    public function create(){
        return view('loadingdock.add', [
            'title' => 'Tambah Data'
        ]);
    }

    public function history(Request $request){
        $title = 'Hapus Data!';
        $text = "Apakah anda yakin akan menghapus data?";
        confirmDelete($title, $text);
        if($request->get('date')){
            $history = LoadingDock::where('date', $request->get('date'))->paginate(15)->withQueryString();
            return view('loadingdock.history')->with('history', $history)->with('title', 'List Data')->with('date', $request->get('date'));
        }
        $history = LoadingDock::paginate(15)->withQueryString();
        return view('loadingdock.history')->with('history', $history)->with('title', 'List Data');
    }

    public function updateCheckbox(Request $request, $id){
        $data = LoadingDock::find($id);
        $check = json_decode($data->data);

        foreach($check as $i => $c){
            if($request->post("check$i") == 'true'){
                $check[$i][6] = true;
            } else {
                $check[$i][6] = false;
            }
        }

        $full = true;
        foreach($check as $i => $c){
            if($c[6] == false){
                $full = false;
            }
        }

        if($full){
            $data->is_checked = 1;
        }

        $data->data = json_encode($check);
        $data->save();
        return redirect()->back();

    }

    public function edit($id){
        $data = LoadingDock::find($id);
        return view('loadingdock.edit', [
            'data' => $data,
            'title' => "Edit Data"
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'docTitle' => 'required',
            'drNum' => 'required',
            'docNum' => 'required',
            'size' => 'required|integer',
            'pt11' => 'required',
            'appjpr' => 'required',
        ]);

        $data = LoadingDock::find($id);

        $docTitle = $request->post('docTitle');
        $drNum  = $request->post('drNum');
        $docNum = $request->post('docNum');
        $size = $request->post('size');
        $pt11 = $request->post('pt11');
        $appjpr = $request->post('appjpr');

        $data->title = $docTitle;
        $data->dr_number = $drNum;
        $data->document_number = $docNum;
        $data->size = $size;
        $data->pt11 = $pt11;
        $data->app_jpr = $appjpr;

        $data->save();

        return redirect('/history');
    }

    public function destroy($id){
        LoadingDock::find($id)->delete();

        return redirect('/history');
    }
}
