@extends('layouts.app')

@auth
@section('content')
<div class="card"> <h1 style='text-align: center'> Form Peminjaman Mobil </h1>
    <div class="card-body">
<div id="form" style="margin-top: 10px">
    <form action="{{ url('mobil/check') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PUT')
        
        <div class="mb-3">
            <label for="tgl_pinjam" class="form-label input-runded"> Tanggal meminjam</label>
            <input type="date" class="form-control Background" name="tgl_pinjam" required>
            @error('tgl_pinjam')
            <div id="tgl_pinjamHelp" class="form-date">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tgl_kembali" class="form-label input-runded"> Tanggal Pengembalian</label>
            <input type="date" class="form-control Background" name="tgl_kembali" required>
            @error('tgl_kembali')
            <div id="tgl_kembaliHelp" class="form-date">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
    </form>
</div>
</div>
</div> 

@endauth
@guest
<h1 style="text-align: center;">Harap Login Terlebih Dahulu!</h1>
@endguest
@endsection

