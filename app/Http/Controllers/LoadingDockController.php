<?php

namespace App\Http\Controllers;

use App\Exports\LoadingDockExport;
use App\Models\LoadingDock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use PDO;

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

    public function download($id){
        $ecc = LoadingDock::find($id);
        $data = json_decode($ecc->data);
        $summary = [];

        $uniqueAssy = array();
        foreach($data as $n){
            if(!in_array($n[1], $uniqueAssy)){
                array_push($uniqueAssy, $n[1]);
            }
        }
        $uniqueAssyList = [];
        foreach($uniqueAssy as $i => $ua){
            $uniqueAssyList[$i] = array();
            foreach($data as $j => $nd){
                if($nd[1] === $ua){
                    array_push($uniqueAssyList[$i], $nd);
                }
            }
        }

        for($i = 0; $i < count($uniqueAssyList); $i++){
            $summaryTemp = [];
            array_push($summaryTemp, $this->groupConsecutive($uniqueAssyList[$i], 5));
            foreach($summaryTemp[0] as $st){
                array_push($summary, $st);
            }
        }

        $totalQuantity = [];
        foreach($summary as $summ){
            $temp = 0;
            foreach($summ as $s){
                $temp += intval($s[4]);
            }
            array_push($totalQuantity, $temp);
        }

        $uniquePallet = array();
        foreach($data as $n){
            if(!in_array($n[0], $uniquePallet)){
                array_push($uniquePallet, $n[0]);
            }
        }

        return view('pdf_template.preview', [
            'data' => $data,
            'totalPoly' => count($data),
            'totalPlt' => count($uniquePallet),
            'docTitle' => $ecc->title,
            'drNum' => $ecc->dr_number,
            'docNum' => $ecc->document_number,
            'size' => $ecc->size,
            'pt11' => $ecc->pt11,
            'appjpr' => $ecc->app_jpr,
            'totalSet' => $ecc->total_set,
            'summary' => $summary,
            'totalQuantity' => $totalQuantity
        ]);

    }

    function groupConsecutive($arr, $key) {
        $groups = [];
        $currentGroup = [];
    
        foreach ($arr as $element) {
            if($element[1] === 'EMPTY'){
                continue;
            }
            if (empty($currentGroup) || intval($currentGroup[count($currentGroup) - 1][$key]) + 1 == $element[$key]) {
                $currentGroup[] = $element;
            } else {
                $groups[] = $currentGroup;
                $currentGroup = [$element];
            }
        }
    
        if (!empty($currentGroup)) {
            $groups[] = $currentGroup;
        }
    
        return $groups;
    }
}
