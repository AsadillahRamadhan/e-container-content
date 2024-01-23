@extends('layouts.main')
@section('container')
<div class="mt-3">
    <form action="/history" id="dateSearch">
        <div class="form-group">
            <label for="">Cari Berdasarkan Tanggal</label>
            <input type="date" name="date" class="form-control" onchange="submit()" value="{{ isset($date) ? $date : ''}}">
        </div>
    </form>
    <table class="table table-striped table-dark text-center">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>No. DR</th>
            <th>No. DOC</th>
            <th>Tipe</th>
            <th>Ukuran</th>
            <th>Total Set</th>
            <th>Total Poly / Total Palet</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
        @php 
        $i = $history->firstItem();
        @endphp
        @foreach($history as $h)
        <tr>
            <td class="align-middle"><b>{{ $i++ }}</b></td>
            <td class="align-middle">{{ $h->title }}</td>
            <td class="align-middle">{{ $h->dr_number }}</td>
            <td class="align-middle">{{ $h->document_number }}</td>
            @if($h->type === 'box')
            <td class="align-middle">BOX</td>
            @elseif($h->type === 'pt56')
            <td class="align-middle">PT.56</td>
            @elseif($h->type === 'pt37')
            <td class="align-middle">PT.37</td>
            @else
            <td class="align-middle">ORICON</td>
            @endif
            <td class="align-middle">{{ $h->size }}</td>
            <td class="align-middle">{{ $h->total_set }}</td>
            <td class="align-middle">{{ $h->total_poly }} POLY / {{ $h->total_palet }} PLT</td>
            @if($h->approved_by_admin == 1)
            <td class="align-middle"><div class="bg-success rounded d-flex items-center justify-content-center"><small><b>Approved By Admin</b></small></div></td>
            @elseif($h->approved_by_ppc == 1)
            <td class="align-middle"><div class="bg-warning rounded d-flex items-center justify-content-center"><small><b>Approved By PPC</b></small></div></td>
            @else
            <td class="align-middle"><div class="bg-danger rounded d-flex items-center justify-content-center"><small><b>Not Approved</b></small></div></td>
            @endif
            <td class="align-middle">{{ $h->date }}</td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-end">
        {{ $history->onEachSide(3)->links() }}
    </div>
</div>
<style>
    small {
        font-size: 10px;
    }
</style>
<script>
    const submit = () => {
        document.querySelector('#dateSearch').submit();
    }
</script>
@endsection