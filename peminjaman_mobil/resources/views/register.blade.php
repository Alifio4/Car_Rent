@extends('layouts.app')
@section('content')
<div class="col-md-4 mx-auto my-5">
    <div class="card">
        <div class="card-body">
            <form action="{{ route("do.register") }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                        name="name" id="name" aria-describedby="nameHelp"
                        placeholder="Masukkan Nama Lengkap" required>
                        @error('name')
                            <div id="nameHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" 
                        name="alamat" id="alamat" aria-describedby="alamatHelp" 
                        placeholder="Masukkan Alamat Lengkap" required>
                        @error('alamat')
                            <div id="alamatHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">Nomer Telepon</label>
                        <input type="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" 
                        name="no_telepon" id="no_telepon" aria-describedby="no_teleponHelp"
                        placeholder="Masukkan Nomer Telepon" required>
                        @error('no_telepon')
                            <div id="no_teleponHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_sim" class="form-label">Nomer SIM</label>
                        <input type="no_sim" class="form-control @error('no_sim') is-invalid @enderror" 
                        name="no_sim" id="no_sim" aria-describedby="no_simHelp"
                        placeholder="Masukkan Nomer SIM" required>
                        @error('no_sim')
                            <div id="no_simHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                        name="email" id="email" aria-describedby="emailHelp"
                        placeholder="Masukkan Email" required>
                        @error('email')
                            <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                        name="password" id="password"
                        placeholder="Masukkan Password" required>
                        @error('password')
                            <div id="passwordHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation">
                        @error('password_confirmation')
                            <div id="passwordConfirmationHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <p>
                        Sudah punya akun?
                        <a href="{{ route('login') }}">silakan login.</a>
                    </p>
                    <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>
    
@endsection