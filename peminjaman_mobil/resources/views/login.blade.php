@extends('layouts.app')

@section('content')
<div class="col-md-4 mx-auto my-5">
    <div class="card">
        <h1 style="text-align: center;"> Menu Login </h1>
        <div class="card-body">
            <div id="form" style="margin-top: 10px">
                <form action="{{ route("do.login") }}" method="post">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="email" class="form-label">Masukan email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                        name="email" id="email" aria-describedby="emailHelp"
                        placeholder="Masukkan Nomer Telepon" required>
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
                    <p>
                        Belum punya akun?
                        <a href="/register">silakan mendaftar.</a>
                    </p>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection