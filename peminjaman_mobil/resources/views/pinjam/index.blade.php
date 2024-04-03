@extends('layouts.app')

@auth
@section('content')


<div class="card">
    <div class="card-body">
        {{-- <form action="/search" method="GET">
            <input type="text" name="search" placeholder="Cari merk/model mobil" value="{{ old('search') }}">
            <input type="submit" value="search"> --}}
      <table class="table" >
        <thead> <h1 style='text-align: center'> Mobil yang tersedia</h1>
          <tr>
            <th scope="col" id="myMenu">Merk</th>
            <th scope="col">Model</th>
            <th scope="col">Nomer Plat</th>
            <th scope="col">Tarif Harian</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($mobil as $no => $item)
        
        <tr>
            <td>{{ $item->merk}}</td>
            <td>{{ $item->model}}</td>
            <td>{{ $item->no_plat }}</td>
            <td>Rp. {{ $item->tarif_harian}}/hari</td>
            <td>
              <div class="container">
                <div class="row">
                  
                  <div class="col">
                    <form action="{{ route('pinjam', $item->id) }}" method="post">
                      @csrf
                      {{-- @foreach ($tanggal as $no => $tgl) --}}
                      <input type="hidden" value="{{$tgl_pinjam}}" name="tgl_pinjam">
                      <input type="hidden" value="{{$tgl_kembali}}" name="tgl_kembali">
                      {{-- @endforeach --}}
                      <button type="submit"
                          class="btn btn-outline-danger">Pinjam</button>
                  </form>
                  </div>
                </div>
              </div>
          </td>
        </tr>
        @endforeach
        
        </tbody>
        
      </table>
    </div>
  </div> 
  @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@if(Session::has('message'))
    <div class="alert alert-info">
        {{ Session::get('message') }}
    </div>
@endif
@if(!empty($message))
  <div class="alert alert-danger"> {{ $message }}</div>
@endif
@endauth
@guest
<h1 style="text-align: center;">Harap Login Terlebih Dahulu!</h1>
@endguest
@endsection

