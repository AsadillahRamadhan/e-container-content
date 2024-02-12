@extends('layouts.main')
@section('container')
<div class="card mb-4 p-3">
<form action="/e-container-content/users/{{ $user->id }}" id="typeForm" method="POST" class="mt-3 text-white" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ $user->name ? $user->name : '' }}">
        @error('name')
            <small class="text-danger">Masukkan nama!</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" class="form-control" value="{{ $user->username ? $user->username : '' }}">
        @error('username')
            <small class="text-danger">Masukkan username!</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="type">Tipe</label>
        <select name="type" class="form-control" id="type">
            <option value="">--PILIH--</option>
            <option value="l/d" {{ $user->type == 'l/d' ? 'selected' : '' }}>Loading Dock</option>
            <option value="ppc" {{ $user->type == 'ppc' ? 'selected' : '' }}>PPC</option>
            <option value="admin" {{ $user->type == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        @error('type')
        <small class="text-danger">Isi kolom tipe!</small>
    @enderror
    </div>
    <div class="d-flex mt-3">
        <a href="/e-container-content/users" class="btn btn-danger me-2">Kembali</a>
        <button class="btn btn-primary">Kirim</button>
    </div>
</form>
</div>
@endsection