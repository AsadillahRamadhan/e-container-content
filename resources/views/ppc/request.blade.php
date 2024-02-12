@extends('layouts.main')
@section('container')
<div class="card mb-4 p-3">
    @foreach($requests as $a => $h)
<form action="/e-container-content/update-checkbox-2/{{ $h->id }}" method="post">
    @csrf
    <input type="hidden" value="{{ $h->id }}" name="oldId">
<div class="modal fade modal-lg" id="check{{ $h->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $h->title }} (No. DOC: {{ $h->document_number }})</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="">Invoice No</label>
                <input type="text" name="invNum" class="form-control plc" value="{{ $h->invoice_number ? $h->invoice_number : '' }}" placeholder="Masukkan No. Invoice..">
                @error('invNum')
                <small class="text-danger text-xs">Masukkan No. Invoice</small>
                @enderror
            </div>
            @if($h->data != null)
            <table class="table align-items-center justify-content-center text-center mb-0">
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NO</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NO PALLET</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ASSY</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" colspan="2">SUFFIX LEVEL</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">QUANTITY (SET)</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">CTN/PLT NUMBER</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">CEK</th>
                </tr>
                @foreach(json_decode($h->data) as $i => $d)
                <tr class="{{ isset($d[8]) ? $d[8] : 'table-secondary' }}">
                    <td class="align-middle text-xs font-weight-bold mb-0">{{ $i + 1 }}</td>
                    <td class="align-middle text-xs text-secondary mb-0">{{ $d[0] }}</td>
                    <td class="align-middle text-xs text-secondary mb-0">{{ $d[1] }}</td>
                    <td class="align-middle text-xs text-secondary mb-0">{{ $d[2] }}</td>
                    <td class="align-middle text-xs text-secondary mb-0">{{ $d[3] }}</td>
                    <td class="align-middle text-xs text-secondary mb-0">{{ $d[4] }}</td>
                    <td class="align-middle text-xs text-secondary mb-0">{{ $d[5] }}</td>
                    <td class="align-middle text-xs text-secondary mb-0"><input type="checkbox" value="true" name="{{ "check$i" }}" {{ $d[7] == true ? 'checked' : ''}}></td>
                </tr>
                @endforeach
            </table>
            <div>
              <h1><small style="font-size: 14px;">Summary</small></h1>
              <table class="table align-items-center justify-content-center text-center mb-0">
                      <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No. Assy</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" colspan="2">Suffix Level</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Quantity</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ctn Number Range</th>
                      </tr>
                  <tbody>
                      @foreach($summary[$a] as $i => $summ)
                      @foreach($summ as $j => $s)
                      <tr>
                        <td class="align-middle text-xs font-weight-bold mb-0">{{ $i + 1 }}</td>
                          <td class="align-middle text-xs text-secondary mb-0">{{ $s[1] }}</td>
                          <td class="align-middle text-xs text-secondary mb-0">{{ $s[2] }}</td>
                          <td class="align-middle text-xs text-secondary mb-0">{{ $s[3] }}</td>
                          <td class="align-middle text-xs text-secondary mb-0">{{ $totalQuantity[$a][$i] }}</td>
                          @if(count($summ) == 1)
                          <td class="align-middle text-xs text-secondary mb-0">{{ $summ[0][5] }}</td>
                          @else
                          <td class="align-middle text-xs text-secondary mb-0">{{ $summ[0][5] }} - {{  $summ[count($summ) - 1][5] }}</td>
                          @endif
                      </tr>
                      @break
                      @endforeach
                      @endforeach
                  </tbody>
              </table>
          </div>
            @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endforeach
    @if(count($requests) > 0)
    <table class="table align-items-center justify-content-center text-center mb-0">
        <thead>
          <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Judul</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No. DR</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No. DOC</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tipe</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ukuran</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Set</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Poly / Total Palet</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
          </tr>
        </thead>
        <tbody>
            @php 
            $i = $requests->firstItem();
            @endphp
            @foreach($requests as $h)
            <tr>
                <td class="align-middle text-xs font-weight-bold mb-0"><b>{{ $i++ }}</b></td>
                <td class="align-middle text-xs text-secondary mb-0">{{ $h->title }}</td>
                <td class="align-middle text-xs text-secondary mb-0">{{ $h->dr_number }}</td>
                <td class="align-middle text-xs text-secondary mb-0">{{ $h->document_number }}</td>
                @if($h->type === 'box')
                <td class="align-middle text-xs text-secondary mb-0">BOX</td>
                @elseif($h->type === 'pt56')
                <td class="align-middle text-xs text-secondary mb-0">PT.56</td>
                @elseif($h->type === 'pt37')
                <td class="align-middle text-xs text-secondary mb-0">PT.37</td>
                @else
                <td class="align-middle text-xs text-secondary mb-0">ORICON</td>
                @endif
                <td class="align-middle text-xs text-secondary mb-0">{{ $h->size }}</td>
                <td class="align-middle text-xs text-secondary mb-0">{{ $h->total_set }}</td>
                <td class="align-middle text-xs text-secondary mb-0">{{ $h->total_poly }} POLY / {{ $h->total_palet }} PLT</td>
                <td class="align-middle text-xs text-secondary mb-0">{{   \Carbon\Carbon::parse($h->date)->format('d M Y') }}</td>
                <td class="align-middle text-xs text-secondary mb-0"><button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#check{{ $h->id }}"><i class="fa-solid fa-check"></i></button></td>
            </tr>
            @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-end">
        {{ $requests->onEachSide(3)->links() }}
    </div>
        @else
        <div class="bg-gradient-secondary rounded d-flex justify-content-center" style="height: 50px; align-items: center">
            <span class="text-bold text-white">Tidak ada data</span>
        </div>
        @endif
</div>
@error('invNum')
@push('js')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        $('#check' + {{ old('oldId') }}).modal('show');
    });
</script>
@endpush
@enderror
@endsection