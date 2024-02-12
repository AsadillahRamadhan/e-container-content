<?php

namespace App\Http\Controllers;

use App\Models\LoadingDock;
use Illuminate\Http\Request;

class PPCController extends Controller
{
    public function request(){
        $requests = LoadingDock::where('is_checked', 1)->where('approved_by_ppc', 0)->paginate(15);
        $data = [];
        foreach($requests as $r){
            array_push($data, json_decode($r->data));
        }

        $uniqueAssy = array();
        foreach($requests as $i => $r){
            $uniqueAssy[$i] = [];
            foreach($data[$i] as $n){
                if(!in_array($n[1], $uniqueAssy[$i])){
                    array_push($uniqueAssy[$i], $n[1]);
                }
            }
        }
        $uniqueAssyList = [];
        foreach($requests as $i => $r){
            $uniqueAssyList[$i] = [];
            foreach($uniqueAssy[$i] as $j => $ua){
                $uniqueAssyList[$i][$j] = [];
                foreach($data[$i] as $k => $nd){
                    if($nd[1] === $ua){
                        array_push($uniqueAssyList[$i][$j], $nd);
                    }
                }
            }
        }

        $summary = [];
        foreach($requests as $h => $r){
            $summary[$h] = [];
            for($i = 0; $i < count($uniqueAssyList[$h]); $i++){
                $summaryTemp = [];
                array_push($summaryTemp, $this->groupConsecutive($uniqueAssyList[$h][$i], 5));
                foreach($summaryTemp[0] as $st){
                    array_push($summary[$h], $st);
                }
            }
        }

        $totalQuantity = [];
        foreach($requests as $h => $r){
            $totalQuantity[$h] = [];
            foreach($summary[$h] as $summ){
                $temp = 0;
                foreach($summ as $s){
                    $temp += intval($s[4]);
                }
                array_push($totalQuantity[$h], $temp);
            }
        }

        return view('ppc.request', [
            'title' => 'Request',
            'requests' => $requests,
            'totalQuantity' => $totalQuantity,
            'summary' => $summary
        ]);
    }

    public function update(Request $request, $id){
        $data = LoadingDock::find($id);
        $check = json_decode($data->data);
        foreach($check as $i => $c){
            if($request->post("check$i") == 'true'){
                $check[$i][7] = true;
            } else {
                $check[$i][7] = false;
            }
        }

        $data->data = json_encode($check);
        $data->save();
        $request->validate([
            'invNum' => 'required'
        ]);

        $full = true;
        foreach($check as $i => $c){
            if($c[7] == false){
                $full = false;
            }
        }

        if($full){
            $data->approved_by_ppc = 1;
        }
        
        
        $data->invoice_number = $request->post('invNum');
        $data->save();
        
        return redirect()->back();
    }

    public function history(Request $request){
        if($request->get('date')){
            $history = LoadingDock::where('date', $request->get('date'))->paginate(15)->withQueryString();
            return view('ppc.history')->with('history', $history)->with('title', 'History')->with('date', $request->get('date'));
        }
        $history = LoadingDock::paginate(15)->withQueryString();
        return view('ppc.history')->with('history', $history)->with('title', 'History');
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
