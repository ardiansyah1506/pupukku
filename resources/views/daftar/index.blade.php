@extends('layout.app')

@section('title')
<title>Pupukku Login</title>
@endsection
@section('content')
    
<div class="daftar-container">

    <div class="login-form">
        <form action="{{ route('daftar.store') }}" method="POST">
            @csrf
            <label for="username">Nama Owner*</label>
            <input type="text" id="owner" name="nama"  required>
            
            <label for="username">Alamat*</label>
            <input type="text" id="alamat" name="alamat"  required>
            
            <label for="username">Nomor HP*</label>
            <input type="text" id="no_hp" name="no_hp"  required>
            
            <label for="username">Nama Perusahaan*</label>
            <input type="text" id="perusahaan" name="perusahaan"  required>
            
            <label for="username">Username*</label>
            <input type="text" id="username" name="username" placeholder="username" required>
            
            <label for="password">Password*</label>
            <input type="password" id="password" name="password" placeholder="Min. 6 karakter" required>
            
            <button type="submit">Login</button>
        </form>
    </div>
    <div class="keterangan-daftar">
        <p>Informasi</p>
        <p>Untuk Pembuatan Username akun</p>
        <p>gunakan '@' pada username yang dibuat</p>
    </div>
</div>
@endsection

@section('js-custom')
@endsection