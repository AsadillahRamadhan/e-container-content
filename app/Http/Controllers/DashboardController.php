<?php

namespace App\Http\Controllers;

use App\Models\LoadingDock;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $total = count(LoadingDock::all());
        $na = count(LoadingDock::where('approved_by_ppc', 0)->where('approved_by_admin', 0)->get());
        $abppc = count(LoadingDock::where('approved_by_ppc', 1)->get());
        $aba = count(LoadingDock::where('approved_by_ppc', 1)->where('approved_by_admin', 1)->get());
        return view('dashboard.index',[
            'title' => 'Dashboard',
            'total' => $total,
            'na' => $na,
            'abppc' => $abppc,
            'aba' => $aba
        ]);
    }
}
