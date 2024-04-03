@extends('layouts.app')

@auth
@section('content')
<div class="card"> <h1 style='text-align: center'>  Form pengembalian Mobil </h1>
  <div class="card-body">
<div id="form" style="margin-top: 10px">
  <form action="{{ url('mobil/kembali') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      @method('PUT')

      
      <select class="form-select" aria-label="Default select example" name="no_plat">
        <option selected="true" disabled="true">Pilih nomer plat mobil yang ingin dikembalikan</option>
        @foreach ($mobil as $no => $item)
        <option value="{{ $item->dipinjam->no_plat }}">{{ $item->dipinjam->no_plat }}</option>
        @endforeach
      </select>

      <div class="mb-3">
          <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      
  </form>
</div>
</div>
</div> 

<div class="card">
    <div class="card-body">
        <form action="/search" method="GET">
            {{-- <input type="text" name="search" placeholder="Cari merk/model mobil" value="{{ old('search') }}">
            <input type="submit" value="search"> --}}
      <table class="table" >
        <thead> <thead> <h1 style='text-align: center'>Riwayat peminjaman mobil</h1> <br>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Merk</th>
            <th scope="col">Model</th>
            <th scope="col">Nomer Plat</th>
            <th scope="col">Total Biaya</th>
            <th scope="col">Tanggal Dipinjam</th>
            <th scope="col">Tanggal Pengembalian</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($mobil as $no => $item)
        <tr>
            <td>{{ $no + 1}}</td>
            <td>{{ $item->dipinjam->merk}}</td>
            <td>{{ $item->dipinjam->model}}</td>
            <td>{{ $item->dipinjam->no_plat }}</td>
            <td>Rp{{ $item->total_biaya}}</td>
            <td>{{ $item->tanggal_mulai}}</td>
            <td>{{ $item->tanggal_selesai}}</td>
            <td>{{ $item->status}}</td>
            
            
        </tr>
        @endforeach
        </tbody>
        
      </table>
      
    </div>
  </div> 

  
@endauth
@guest
<h1 style="text-align: center;">Harap Login Terlebih Dahulu!</h1>
@endguest
@endsection

