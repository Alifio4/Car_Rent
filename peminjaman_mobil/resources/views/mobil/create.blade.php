@extends('layouts.app')

@section('content')
<div id="form" style="margin-top: 10px">
    <form action="{{ url('mobil/store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PUT')
        <div class="mb-3">
            <label for="merk" class="form-label input-runded"> Merk Mobil </label>
            <input type="text" class="form-control Background" name="merk" required>
            @error('merk')
                <div id="merkHelp" class="form-text">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="model" class="form-label input-runded"> Model Mobil</label>
            <input type="text" class="form-control Background" name="model" required>
            @error('model')
            <div id="modelHelp" class="form-text">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="no_plat" class="form-label input-runded"> Plat Nomor Mobil</label>
            <input type="text" class="form-control Background" name="no_plat" required>
            @error('no_plat')
            <div id="no_platHelp" class="form-text">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tarif_harian" class="form-label input-runded"> Masukan Tarif Harian</label>
            <input type="text" class="form-control Background" name="tarif_harian"
            placeholder="Contoh: 100000" required>
            @error('tarif_harian')
            <div id="tarif_harianHelp" class="form-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
    </form>
</div>
@endsection

