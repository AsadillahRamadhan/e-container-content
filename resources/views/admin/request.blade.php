@extends('layouts.main')
@section('container')
<div class="card mb-4 p-3">
    @foreach($requests as $a => $h)
        <form action="/e-container-content/update-container-number/{{ $h->id }}" method="post">
            @csrf
            <input type="hidden" value="{{ $h->id }}" name="oldId">
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
                        <small class="text-danger">Masukkan No. Container</small>
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
    @endforeach
    @if(count($requests) > 0)
    <table class="table align-items-center justify-content-center text-center mb-0">
        <thead>
          <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Judul</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No. DR</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No. DOC</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No. Inv</th>
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
            <td class="align-middle text-xs text-secondary mb-0">{{ $h->invoice_number }}</td>
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
            <td><button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#check{{ $h->id }}"><i class="fa-solid fa-check"></i></button></td>
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
@error('conNum')
@push('js')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        $('#check' + {{ old('oldId') }}).modal('show');
    });
</script>
@endpush
@enderror
@endsection