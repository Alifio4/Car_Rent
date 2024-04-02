<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\mobil;
use App\Models\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $data["mobil"] = mobil::where('id',1)->get();
        // dd ($data);
    $data["mobil"] = mobil::
    where(function ($query) {
        $query->whereDate('tanggal_mulai', '>=', request('tgl_kembali'))
            ->orwhereDate('tanggal_selesai', '<=', request('tgl_pinjam'))
            ->orwhereNull('tanggal_mulai');
    })->get();
    $data2["tanggal"] = [
        'tgl_pinjam'  => $request->tgl_pinjam,
        'tgl_kembali'   => $request->tgl_kembali
    ];
    $tgl_pinjam  = $request->tgl_pinjam;
    $tgl_kembali   = $request->tgl_kembali;
    //  dd ($data2);
    
    return view("pinjam.index",$data,compact('tgl_pinjam','tgl_kembali'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function form()
    {
    $data["mobil"] = mobil::all(); 
 
    return view("pinjam.form",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        
        // $request->validate([
        //     'merk' => ['required','string', 'max:100'],
        //     'model' => ['required','string', 'max:100'],
        //     'no_plat' => ['required','string', 'max:100', 'unique:'.mobil::class],
        //     'tarif_harian' => ['required','integer'],
            
        // ]);
        $car = mobil::find($id);
            $item = new peminjaman;
            $item->id_user = Auth::id();
            $item->id_mobil = $id;
            $item->tanggal_mulai  = Carbon::parse($request->tgl_pinjam);
            $item->tanggal_selesai   = Carbon::parse($request->tgl_kembali);
            $days = $item->tanggal_mulai->diffInDays($item->tanggal_selesai);
            $item->total_biaya = $days* $car->tarif_harian;
            $item->status = "Dipinjam";
            // dd ($item->total_biaya);
            $item->save();

            
            $car->tanggal_mulai  = Carbon::parse($request->tgl_pinjam);
            $car->tanggal_selesai   = Carbon::parse($request->tgl_kembali);
            $car->ketersediaan = "dipinjam";
            $car->save();
        
    
        return redirect('mobil');
    }

    /**
     * Display the specified resource.
     */
    public function pengembalian(peminjaman $peminjaman)
    {
        $data["mobil"] = peminjaman::with('dipinjam')->where('id_user', Auth::id())->get(); 
        
 
    return view("pengembalian.index",$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(peminjaman $peminjaman)
    {
        //
    }
}
