<?php

namespace App\Http\Controllers;

use App\Models\LoadingDock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Spatie\Browsershot\Browsershot;

class AdminController extends Controller
{
    public function request(){
        $requests = LoadingDock::where('is_checked', 1)->where('approved_by_ppc', 1)->where('approved_by_admin', 0)->paginate(15);
        return view('admin.request', [
            'title' => 'Request',
            'requests' => $requests
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'conNum' => 'required'
        ]);
        $data = LoadingDock::find($id);
        $data->container_number = $request->post('conNum');
        if($data->container_number != null){
            $data->approved_by_admin = 1;
        }
        // $data->save();
        // $html = View::make('pdf_template.preview', [
        //     'data' => $newData,
        //     'totalPoly' => count($newData),
        //     'totalPlt' => count($uniquePallet),
        //     'docTitle' => $docTitle,
        //     'drNum' => $drNum,
        //     'docNum' => $docNum,
        //     'size' => $size,
        //     'pt11' => $pt11,
        //     'appjpr' => $appjpr,
        //     'totalSet' => $totalSet,
        //     'summary' => $summary,
        //     'totalQuantity' => $totalQuantity

        // ])->render();
        // Browsershot::html($html)->savePdf('lokasi_dan_nama_file_pdf.pdf');
        return redirect()->back();
    }

    public function history(Request $request){
        if($request->get('date')){
            $history = LoadingDock::where('date', $request->get('date'))->paginate(15)->withQueryString();
            return view('admin.history')->with('history', $history)->with('title', 'History')->with('date', $request->get('date'));
        }
        $history = LoadingDock::paginate(15)->withQueryString();
        return view('admin.history')->with('history', $history)->with('title', 'History');
    }
}
