@extends('layouts.main')
@section('container')
<div class="card mb-4 p-3">
<form action="/e-container-content/users" id="typeForm" method="POST" class="mt-3 text-white" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') ? old('name') : '' }}">
        @error('name')
            <small class="text-danger">Masukkan nama!</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" class="form-control" value="{{ old('username') ? old('username') : '' }}">
        @error('username')
            <small class="text-danger">Masukkan username!</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <div class="" style="display: flex; align-items: center;">
            <input type="password" id="password" name="password" value="{{ old('password') ? old('password') : '' }}" class="form-control me-3">
            <i class="fa-solid fa-eye-slash fa-lg text-secondary" id="toggle" onclick="toggleButton()"></i>tes
        </div>
        @error('password')
            <small class="text-danger">Masukkan password!</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="type">Tipe</label>
        <select name="type" class="form-control" id="type">
            <option value="">--PILIH--</option>
            <option value="l/d" {{ old('type') == 'l/d' ? 'selected' : '' }}>Loading Dock</option>
            <option value="ppc" {{ old('type') == 'ppc' ? 'selected' : '' }}>PPC</option>
            <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Admin</option>
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
<script>
    const toggleButton = () => {
        let button = document.querySelector('#toggle').classList;
        let input = document.querySelector('#password').type;
        button.toggle('fa-eye');
        button.toggle('fa-eye-slash');
        if(button.contains('fa-eye')){
            document.querySelector('#password').type = 'text';
        } else {
            document.querySelector('#password').type = 'password';
        }
    
    }
</script>
@endsection