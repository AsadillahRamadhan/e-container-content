<?php

namespace App\Http\Controllers;

use App\Imports\BoxImport;
use App\Models\LoadingDock;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BoxController extends Controller
{
    public function create(){
        return view('box.add',[
            'title' => 'BOX',
        ]);
    }

    public function index(){
        $boxes = LoadingDock::where('type', 'box')->orderByDesc('created_at')->paginate(15);
        return view('box.index', [
            'boxes' => $boxes,
            'title' => 'BOX'
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
        $data = Excel::toArray(new BoxImport, $request->file('rawFile'), null, \Maatwebsite\Excel\Excel::XLS);

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
        $ld->type = 'box';
        $ld->approved_by_ppc = 0;
        $ld->approved_by_admin = 0;
        $ld->save();

        $coll = collect($newData);
        $tes = $coll->chunk(45);
        $final = [
            'data' => $coll,
            'totalPoly' => count($newData),
            'totalPlt' => count($uniquePallet),
            'docTitle' => $docTitle,
            'drNum' => $drNum,
            'docNum' => $docNum,
            'size' => $size,
            'pt11' => $pt11,
            'appjpr' => $appjpr,
            'totalSet' => $totalSet

        ];

        return PDF::loadView('preview', $final)->setPaper('A4')->stream();

        
        $pdf = Pdf::loadView('previewtemp', $final);
        return $pdf->download('invoice.pdf');
        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/bills/bubla.pdf',$content);
        
        return redirect('box');

       
    }

    public function destroy($id){
        LoadingDock::find($id)->delete();

        return redirect('/box');
    }


    public function edit($id){
        $data = LoadingDock::find($id);
        return view('box.edit', [
            'data' => $data,
            'title' => 'BOX'
        ]);
    }
}
