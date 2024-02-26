<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome/css/brands.min.css') }}">
</head>
<body>
    <div class="row">
        <div class="col-sm-9">
            <table style="width: 100%; font-size: 10px;" class="text-center me-3">
                <tr style="border: 0;">
                    <td colspan="9" class="text-center font-bold border-none"><h1><small style="font-size: 14px;">CONTAINER CONTENT</small> SEA FREIGHT</h1></td>
                </tr>
                <tr>
                    <th style="width: 10%; height: 20px;">NO</th>
                    <th>NO PALLET</th>
                    <th>ASSY</th>
                    <th colspan="2">SUFFIX LEVEL</th>
                    <th>QUANTITY (SET)</th>
                    <th>CTN NUMBER</th>
                    <th>CEK 1</th>
                    <th>CEK 2</th>
                </tr>
                @foreach($data as $i => $d)
                <tr class="{{ isset($d[8]) ? $d[8] : 'table-primary' }}">
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $d[0] }}</td>
                    <td>{{ $d[1] }}</td>
                    <td>{{ $d[2] }}</td>
                    <td>{{ $d[3] }}</td>
                    <td>{{ $d[4] }}</td>
                    <td>{{ $d[5] }}</td>
                    <td></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                @endforeach
            </table>
            <div>
                <h1><small style="font-size: 14px;">Summary</small></h1>
                <table style="width: 100%; font-size: 10px;" class="text-center me-3">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>No. Assy</td>
                            <td colspan="2">Suffix Level</td>
                            <td>Total Quantity</td>
                            <td>Ctn Number Range</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($summary as $i => $summ)
                        @foreach($summ as $j => $s)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $s[1] }}</td>
                            <td>{{ $s[2] }}</td>
                            <td>{{ $s[3] }}</td>
                            <td>{{ $totalQuantity[$i] }}</td>
                            @if(count($summ) == 1)
                            <td>{{ $summ[0][5] }}</td>
                            @else
                            <td>{{ $summ[0][5] }} - {{  $summ[count($summ) - 1][5] }}</td>
                            @endif
                        </tr>
                        @break
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-3">
            <h6>Tanggal: {{ date('d-m-Y') }}</h6>
            <h5 class="text-center mt-3"><b>{{ $docTitle }}</b></h5>
            <h6 class="mt-2">Invoice No : {{ $document_number }}</h6>
            <h6 class="mt-2">No. DR : <b>{{ $drNum }}</b></h6>
            <h6 class="mt-2">No. DOC :  <b>{{ $docNum }}</b></h6>
            <h6 class="mt-2">No. Container: {{ $container_number }}</h6>
            <table class="text-center mt-3" style="width: 100%">
                <tr>
                    <td><i style="font-weight: {{ $size == 20 ? '800' : '500' }}">20 FEET</i></td>
                    <td><i style="font-weight: {{ $size == 40 ? '800' : '500' }}">40 FEET</i></td>
                </tr>
            </table>
            <table style="width: 100%; height: 60px;" class="text-center mt-4">
                <tr class="d-flex">
                    <td style="width: 50%; height: 60px;" class="flex items-center justify-content-center"><small><b>GATE NO</b></small></td>
                    <td style="width: 50%; height: 60px"></td>
                </tr>
            </table>
            <table class="mt-2 note" style="width: 75%; font-weight:600;">
                <tr class="note">
                    <td class="note">Note : </td>
                    <td class="note"><small>PT11 = {{ $pt11 }}<br>APP/JPR = {{ $appjpr }}</small></td>
                </tr>
            </table>
            <h6 style="font-size: 10px;" class="mt-2">TOTAL SET : {{ $totalSet }}</h6>
            <h6 class="text-center mt-3" style="font-size: 14px"><b>TOTAL POLY/PALET</b></h5>
            <div class="mt-2 flex items-center justify-content-center pt-1" style="width: 100%; height: 60px; border: 2px solid black">
                <h5><b>{{ $totalPoly }} POLY/{{ $totalPlt }} PLT</b></h5>
            </div>
            <table style="width: 70px;" class="text-center mt-3">
                <tr>
                    <td><h6 style="font-weight: bold; font-size: 12px;">CHECK</h6></td>
                </tr>
                <tr style="height: 50px">
                    <td></td>
                </tr>
                <tr>
                    <td><h6 style="font-weight: bold; font-size: 12px;">PIC</h6></td>
                </tr>
            </table>
            <div class="mt-3" style="font-size: 8px;">
                <h6><small>KETERANGAN CEK ( V ) : </small></h6>
                <h6><small>a. CEK 1 identifikasi assy, suffix, level, qty, carton no</small></h6>
                <h6><small>b. CEK 2 Pastikan data oracle sesuai content by PPC</small></h6>
            </div>
            <div class="mt-4">
                <h6><small>*NOTE : Jika ada proses manual</small></h6>
                <table style="width: 100%; font-size: 9px" class="text-center">
                    <tr>
                        <td colspan="3">MENGETAHUI MANUAL UPDATE</td>
                    </tr>
                    <tr style="height: 40px">
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="width: 33%">GL/FRM EXIM</td>
                        <td style="width: 33%">SPV EXIM</td>
                        <td style="width: 33%">SPV PPC</td>
                    </tr>
                </table>
            </div>
            <div class="mt-3">
                <table style="width: 100%; font-size: 10px; font-weight: 600" class="text-center">
                    <tr>
                        <td>APPROVED</td>
                        <td>CHECKED</td>
                        <td>PREPARED</td>
                    </tr>
                    <tr style="height: 50px">
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="width: 33%">SPV</td>
                        <td style="width: 33%">FRM</td>
                        <td style="width: 33%">GL</td>
                    </tr>
                </table>
                <h6 style="font-size: 10px" class="mt-1">*Note: SPV & FRM sign setelah proses stuffing selesai (H+1)</h6>
            </div>
        </div>
        
    </div>
</body>
<style>
    table {
    border-collapse: collapse;
    border-spacing: 0;
    margin: 0;
    padding: 0;
  }
  
    table, th, td {
        border: 1px solid black;
    }

    .note {
        border: 1px solid white;
        font-size: 14px;
    }

    .flex {
        display: flex;
    }

    .items-center {
        align-items: center;
    }

    .justify-content-center {
        justify-content: center;
    }

    h6 {
        font-size: 10px;
    }

    h5 {
        font-size: 16px;
    }

    .striped {
        background-color: #cbcbcb;
    }

    i {
        font-size: 12px;
    }

    .page-break {
    page-break-after: always;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        window.print();
    });

    window.onafterprint = () => {
        window.close();
    }


    
</script>
</html>