@extends('layouts.app')

@auth
@section('content')
<div class="card">
    <div class="card-body">
        <form action="/search" method="GET">
            <input type="text" name="search" placeholder="Cari merk/model mobil" value="{{ old('search') }}">
            <input type="submit" value="search">
      <table class="table" >
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col" id="myMenu">Merk</th>
            <th scope="col">Model</th>
            <th scope="col">Nomer Plat</th>
            <th scope="col">Tarif Harian</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($mobil as $no => $item)
        <tr>
            <td>{{ $no + 1}}</td>
            <td>{{ $item->merk}}</td>
            <td>{{ $item->model}}</td>
            <td>{{ $item->no_plat }}</td>
            <td>Rp. {{ $item->tarif_harian}}/hari</td>
            
        </tr>
        @endforeach
        </tbody>
        
      </table>
      <td><a class="btn btn-primary" href="mobil/create" role="button">Tambahkan Mobil</a></td> 
    </div>
  </div> 
  
@endauth
@guest
<h1 style="text-align: center;">Harap Login Terlebih Dahulu!</h1>
@endguest
@endsection

