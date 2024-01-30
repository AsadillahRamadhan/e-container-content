@extends('layouts.main')
@section('container')
<div class="card mb-4 p-3">
<form action="/loadingdock/{{ $data->id }}" method="POST" class="mt-3 text-white" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="docTitle">Tipe</label>
        @if($data->type === 'pt37')
        <input type="text" class="plc form-control" value="PT-37" disabled>
        @elseif($data->type === 'pt56')
        <input type="text" class="plc form-control" value="PT-56" disabled>
        @elseif($data->type === 'oricon')
        <input type="text" class="plc form-control" value="ORICON" disabled>
        @elseif($data->type === 'box')
        <input type="text" class="plc form-control" value="BOX" disabled>
        @endif
    </div>
    <div class="form-group">
        <label for="docTitle">Judul Dokumen</label>
        <input type="text" class="plc form-control" value="{{ $data ? $data->title : '' }}" id="docTitle" name="docTitle" placeholder="Masukkan judul dokumen...">
        @error('docTitle')
            <small class="text-danger">Masukkan judul dokumen</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="drNum">No. DR</label>
        <input type="text" class="plc form-control" id="drNum" value="{{ $data ? $data->dr_number : '' }}" name="drNum" placeholder="Masukkan Nomor DR...">
        @error('drNum')
        <small class="text-danger">Masukkan No. DR</small>
    @enderror
    </div>
    <div class="form-group">
        <label for="docNum">No. DOC</label>
        <input type="text" class="plc form-control" id="docNum" value="{{ $data ? $data->document_number : '' }}" name="docNum" placeholder="Masukkan Nomor Dokumen...">
        @error('docNum')
        <small class="text-danger">Masukkan No. DOC</small>
    @enderror
    </div>
    <div class="form-group">
        <label for="size">Size</label>
        <select name="size" class="form-control" id="size">
            <option value="a">--PILIH--</option>
            <option value="20" {{ $data->size == 20 ? 'selected' : '' }}>20 FEET</option>
            <option value="40" {{ $data->size == 40 ? 'selected' : '' }}>40 FEET</option>
        </select>
        @error('size')
        <small class="text-danger">Isi kolom size</small>
    @enderror
    </div>
    <div class="form-group">
        <label for="pt11">PT11</label>
        <input type="number" class="plc form-control" id="pt11" value="{{ $data ? $data->pt11 : '' }}" name="pt11" placeholder="Masukkan jumlah PT11...">
        @error('pt11')
        <small class="text-danger">Masukkan jumlah PT11</small>
    @enderror
    </div>
    <div class="form-group">
        <label for="appjpr">APP/JPR</label>
        <input type="number" class="plc form-control" id="appjpr" name="appjpr" value="{{ $data ? $data->app_jpr: '' }}" placeholder="Masukkan jumlah APP/JPR...">
        @error('appjpr')
        <small class="text-danger">Masukkan jumlah APP/JPR</small>
    @enderror
    </div>
    <div class="d-flex mt-3">
        <a href="/history" class="btn btn-danger me-2">Kembali</a>
        <button class="btn btn-primary">Kirim</button>
    </div>
</form>
</div>

<style>
    #doctitle{
        height: 30px;
        width: 400px;
    }

    .plc::placeholder {
        color: rgb(150, 150, 150);
    }
</style>
@endsection