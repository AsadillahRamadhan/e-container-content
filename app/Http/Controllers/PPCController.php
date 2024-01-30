<?php

namespace App\Http\Controllers;

use App\Models\LoadingDock;
use Illuminate\Http\Request;

class PPCController extends Controller
{
    public function request(){
        $requests = LoadingDock::where('is_checked', 1)->where('approved_by_ppc', 0)->paginate(15);
        return view('ppc.request', [
            'title' => 'Request',
            'requests' => $requests
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
}
