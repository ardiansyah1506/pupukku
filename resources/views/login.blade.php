@extends('layout.app')

@section('title')
<title>Pupukku Login</title>
@endsection
@section('content')
    
<div class="login-container">
    <!-- Gambar Ilustrasi -->
    <div class="login-image"></div>
    <!-- Form Login -->
    <div class="login-form">
        <h1>Pupukku</h1>
        <p>Selamat Datang</p>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="username">Username*</label>
            <input type="text" id="username" name="username" placeholder="Username" required>
            
            <label for="password">Password*</label>
            <input type="password" id="password" name="password" placeholder="Min. 6 karakter" required>
            
            <button type="submit">Login</button>
        </form>
    
        <div style="margin-top: 10px; text-align: center;">
            <a href="{{ route('daftar.index') }}">
                <button class="btn1" type="button">Register</button>
            </a>
        </div>
    </div>
    
</div>
@endsection

@section('js-custom')
@endsection