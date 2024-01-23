<?php

namespace App\Http\Controllers;

use App\Imports\Pt56Import;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Pt56Controller extends Controller
{
    public function index(){
        return view('pt56.index',[
            'title' => 'PT.56'
        ]);
    }



    public function convert(Request $request){

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

        $empty = [null, 'EMPTY', 'EMPTY', 'EMPTY', 'EMPTY', 'EMPTY'];
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
                    $newData[$i][6] = 'striped';
                }
            }
        }

        return view('preview', [
            'data' => $newData,
            'totalPoly' => count($newData),
            'totalPlt' => count($uniquePallet),
            'docTitle' => $docTitle,
            'drNum' => $drNum,
            'docNum' => $docNum,
            'size' => $size,
            'pt11' => $pt11,
            'appjpr' => $appjpr,
            'totalSet' => $totalSet

        ]);
    }
}
