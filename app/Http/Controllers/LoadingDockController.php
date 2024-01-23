<?php

namespace App\Http\Controllers;

use App\Models\LoadingDock;
use Illuminate\Http\Request;

class LoadingDockController extends Controller
{
    public function history(Request $request){
        if($request->get('date')){
            $history = LoadingDock::where('date', $request->get('date'))->paginate(15)->withQueryString();
            return view('loadingdock.history')->with('history', $history)->with('title', 'History')->with('date', $request->get('date'));
        }
        $history = LoadingDock::paginate(15)->withQueryString();
        return view('loadingdock.history')->with('history', $history)->with('title', 'History');

        
    }
}
