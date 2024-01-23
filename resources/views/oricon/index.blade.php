@extends('layouts.main')
@section('container')
<form action="/oricon" method="POST" class="mt-3 text-white" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="docTitle">Judul Dokumen</label>
        <input type="text" class="plc form-control" value="{{ old('docTitle') ? old('docTitle') : '' }}" id="docTitle" name="docTitle" placeholder="Masukkan judul dokumen...">
        @error('docTitle')
            <small class="text-info">Masukkan judul dokumen</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="drNum">No. DR</label>
        <input type="text" class="plc form-control" id="drNum" value="{{ old('drNum') ? old('drNum') : '' }}" name="drNum" placeholder="Masukkan Nomor DR...">
        @error('drNum')
        <small class="text-info">Masukkan No. DR</small>
    @enderror
    </div>
    <div class="form-group">
        <label for="docNum">No. DOC</label>
        <input type="text" class="plc form-control" id="docNum" value="{{ old('docNum') ? old('docNum') : '' }}" name="docNum" placeholder="Masukkan Nomor Dokumen...">
        @error('docNum')
        <small class="text-info">Masukkan No. DOC</small>
    @enderror
    </div>
    <div class="form-group">
        <label for="size">Size</label>
        <select name="size" class="form-control" id="size">
            <option value="a">--PILIH--</option>
            <option value="20" {{ old('size') == 20 ? 'selected' : '' }}>20 FEET</option>
            <option value="40" {{ old('size') == 40 ? 'selected' : '' }}>40 FEET</option>
        </select>
        @error('size')
        <small class="text-info">Isi kolom size</small>
    @enderror
    </div>
    <div class="form-group">
        <label for="pt11">PT11</label>
        <input type="text" class="plc form-control" id="pt11" value="{{ old('pt11') ? old('pt11') : '' }}" name="pt11" placeholder="Masukkan jumlah PT11...">
        @error('pt11')
        <small class="text-info">Masukkan jumlah PT11</small>
    @enderror
    </div>
    <div class="form-group">
        <label for="appjpr">APP/JPR</label>
        <input type="text" class="plc form-control" id="appjpr" name="appjpr" value="{{ old('appjpr') ? old('appjpr') : '' }}" placeholder="Masukkan jumlah APP/JPR...">
        @error('appjpr')
        <small class="text-info">Masukkan jumlah APP/JPR</small>
    @enderror
    </div>
    <div class="form-group">
        <label for="rawFile">Raw File</label>
        <input type="file" class=" form-control" id="rawFile" name="rawFile">
        @error('rawFile')
        <small class="text-info">Masukkan file raw</small>
    @enderror
    </div>
    <button class="btn btn-primary mt-3">Convert</button>
</form>

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