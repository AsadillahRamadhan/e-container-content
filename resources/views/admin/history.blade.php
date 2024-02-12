@extends('layouts.main')
@section('container')
@foreach($history as $h)
@if($h->approved_by_ppc == 1)
<form action="/e-container-content/update-container-number/{{ $h->id }}" method="post">
    @csrf
<div class="modal fade" id="check{{ $h->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $h->title }} (No. DOC: {{ $h->document_number }})</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="">No. Container</label>
                <input type="text" name="conNum" class="form-control plc" value="{{ $h->container_number ? $h->container_number : '' }}" placeholder="Masukkan No. Container..">
                @error('conNum')
                <small class="text-info">Masukkan No. Container</small>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endif
@endforeach
<div class="row">
    <div class="col-12">
      <div class="card mb-4 px-2">
        <div class="card-header pb-0">
            <form action="/e-container-content/history-admin" id="dateSearch">
                <div class="form-group">
                    <label for="">Cari Berdasarkan Tanggal</label>
                    <input type="date" name="date" class="form-control" onchange="submit()" value="{{ isset($date) ? $date : ''}}">
                </div>
            </form>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No. DR</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No. DOC</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No. Inv</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No. Ctr</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipe</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ukuran</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Set</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Poly / Total Palet</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                </tr>
              </thead>
              <tbody class="text-center">
                @php 
                $i = $history->firstItem();
                @endphp
                @foreach($history as $h)
                <tr>
                    <td class="align-middle text-xs font-weight-bold mb-0"><b>{{ $i++ }}</b></td>
                    <td class="align-middle text-xs text-secondary mb-0">{{ $h->title }}</td>
                    <td class="align-middle text-xs text-secondary mb-0">{{ $h->dr_number }}</td>
                    <td class="align-middle text-xs text-secondary mb-0">{{ $h->document_number }}</td>
                    <td class="align-middle text-xs text-secondary mb-0">{{ $h->invoice_number ? $h->invoice_number : 'N/A' }}</td>
                    <td class="align-middle text-xs text-secondary mb-0">{{ $h->container_number ? $h->invoice_number : 'N/A' }}</td>
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
                    @if($h->approved_by_admin == 1)
                    <td class="align-middle text-xs text-secondary mb-0"><div class="bg-gradient-success text-white p-1 rounded d-flex items-center justify-content-center"><small><b>Approved By Admin</b></small></div></td>
                    @elseif($h->approved_by_ppc == 1)
                    <td class="align-middle text-xs text-secondary mb-0"><div class="bg-gradient-warning text-white p-1 rounded d-flex items-center justify-content-center"><small><b>Approved By PPC</b></small></div></td>
                    @else
                    <td class="align-middle text-xs text-secondary mb-0"><div class="bg-gradient-danger text-white p-1 rounded d-flex items-center justify-content-center"><small><b>Not Approved</b></small></div></td>
                    @endif
                    <td class="align-middle text-xs text-secondary mb-0">{{   \Carbon\Carbon::parse($h->date)->format('d M Y') }}</td>
                    @if($h->approved_by_ppc == 1)
                    <td class="align-middle d-flex items-center justify-content-center"><button class="btn bg-gradient-info me-2" data-bs-toggle="modal" data-bs-target="#check{{ $h->id }}"><i class="fa-solid fa-edit"></i></button></td>
                    @else
                    <td class="align-middle text-xs text-secondary mb-0">N/A</td>
                    @endif
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-end">
        {{ $history->onEachSide(3)->links() }}
    </div>
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