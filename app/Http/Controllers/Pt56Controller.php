<?php

namespace App\Http\Controllers;

use App\Imports\Pt56Import;
use App\Models\LoadingDock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Facades\Excel;

class Pt56Controller extends Controller
{
    public function index(){
        $pt56 = LoadingDock::where('type', 'pt56')->where('is_checked', false)->orderByDesc('created_at')->paginate(15);
        $title = 'Hapus Data!';
        $text = "Apakah kamu yakin?";
        confirmDelete($title, $text);
        return view('pt56.index', [
            'pt56' => $pt56,
            'title' => 'PT.56'
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'docTitle' => 'required',
            'drNum' => 'required',
            'docNum' => 'required',
            'size' => 'required|integer',
            'pt11' => 'required',
            'appjpr' => 'required',
            'rawFile' => 'required|mimes:xls,xlsx'
        ]);

        $docTitle = $request->post('docTitle');
        $drNum  = $request->post('drNum');
        $docNum = $request->post('docNum');
        $size = $request->post('size');
        $pt11 = $request->post('pt11');
        $appjpr = $request->post('appjpr');
        $totalSet = $request->post('totalSet');
        $data = Excel::toArray(new Pt56Import, $request->file('rawFile'), null, \Maatwebsite\Excel\Excel::XLS);
        
        $newData = array();
        foreach($data[0] as $i => $d){
            if($i != 0){
                $temp = explode('/', $d[3]);
                $temp[3] = intval($temp[3]);
                $temp[4] = intval($temp[4]);
                $newData[$i-1][0] = $d[2];
                $newData[$i-1][1] = $temp[0];
                $newData[$i-1][2] = $temp[2];
                $newData[$i-1][3] = $temp[3];
                $newData[$i-1][4] = $temp[1];
                $newData[$i-1][5] = $temp[4];
                $newData[$i-1][6] = false;
                $newData[$i-1][7] = false;
            }
        }
        
        $totalSet = 0;
        foreach($newData as $d){
            $totalSet += intval($d[4]);
        }

        $uniquePallet = array();
        foreach($newData as $n){
            if(!in_array($n[0], $uniquePallet)){
                array_push($uniquePallet, $n[0]);
            }
        }

        $uniquePalletList = array();
        $lastIndexes = array();
        foreach($uniquePallet as $i => $u){
            $uniquePalletList[$i] = array();
            foreach($newData as $j => $n){
                if($n[0] === $u){
                    array_push($uniquePalletList[$i], $n[0]); 
                    $lastIndexes[$i] = $j;
                }
            }
        }

        $mustFilledWithEmpty = [];
        $filledRequired = [];
        foreach($uniquePalletList as $upl){
            if(count($upl) % 4 != 0){
                array_push($mustFilledWithEmpty, $upl[0]);
                $temp = count($upl);
                if(count($upl) > 4){
                    $temp = count($upl) % 4;
                }

                array_push($filledRequired, (4 - $temp));
            }
        }

        $empty = [null, 'EMPTY', 'EMPTY', 'EMPTY', 'EMPTY', 'EMPTY', false, false];
        $countedIndex = 0;
        foreach($mustFilledWithEmpty as $i => $mfwe){
            $empty[0] = $mfwe;
            foreach($uniquePallet as $j => $up){
                if($up === $mfwe){
                    $temp = ++$lastIndexes[$j];
                    for($k = 0; $k < $filledRequired[$i]; $k++){
                        array_splice($newData, $temp + $countedIndex, 0, [$empty]);
                        $countedIndex++;
                    }
                }
            }
        }

        

        $striped = array();
        foreach($uniquePallet as $i => $up){
            if($i % 2 != 0){
                array_push($striped, $up);
            }
        }

        foreach($newData as $i => $nd){
            foreach($striped as $s){
                if($nd[0] === $s){
                    $newData[$i][8] = 'striped';
                }
            }
        }

        $uniqueAssy = array();
        foreach($newData as $n){
            if(!in_array($n[1], $uniqueAssy)){
                array_push($uniqueAssy, $n[1]);
            }
        }

        $uniqueAssyList = [];
        foreach($uniqueAssy as $i => $ua){
            $uniqueAssyList[$i] = array();
            foreach($newData as $j => $nd){
                if($nd[1] === $ua){
                    array_push($uniqueAssyList[$i], $nd);
                }
            }
        }
        for($i = 0; $i < count($uniqueAssyList); $i++){
            $uniqueAssyList[$i] = $this->bubbleSort($uniqueAssyList[$i]);
        }

        $summary = [];
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

        $ld = new LoadingDock();
        $ld->title = $docTitle;
        $ld->dr_number = $drNum;
        $ld->document_number = $docNum;
        $ld->size = $size;
        $ld->pt11 = $pt11;
        $ld->app_jpr = $appjpr;
        $ld->total_set = $totalSet;
        $ld->total_poly = count($newData);
        $ld->total_palet = count($uniquePallet);
        $ld->document_link = 'tes';
        $ld->date = Date::now();
        $ld->type = 'pt56';
        $ld->data = json_encode($newData);
        $ld->approved_by_ppc = 0;
        $ld->approved_by_admin = 0;
        $ld->is_checked = 1;
        $ld->save();

        return redirect('/e-container-content/history');
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

    function bubbleSort($arr) {
        $n = count($arr);
        for ($i = 0; $i < $n-1; $i++) {
            for ($j = 0; $j < $n-$i-1; $j++) {
                if ($arr[$j][5] > $arr[$j+1][5]) {
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j+1];
                    $arr[$j+1] = $temp;
                }
            }
        }
        return $arr;
    }
}
