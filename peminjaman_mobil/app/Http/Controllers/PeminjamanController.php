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
    // $data["mobil"] = mobil::
    // where(function ($query) {
    //     $query->whereDate('tanggal_mulai', '>=', request('tgl_kembali'))
    //         ->orwhereDate('tanggal_selesai', '<=', request('tgl_pinjam'))
    //         ->orwhereNull('tanggal_mulai');
    // })->get();
    $data["mobil"] = mobil::all(); 
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
        // 29 31 pinjam kembali gamasuk (sudah benar)
        // 2024-04-29 2024-04-30 mulai selesai
        //28 30 pinjam kembali gamasuk (sudah benar)

        // 1 5 pinjam kembali

        //fungsi filter apakah mobil sedang dipinjam pada tanggal tersebut 
        // kalo masuk sini harusnya gaboleh
        $pinjam = peminjaman::pluck('id');
        $data = null;
        $last_record = peminjaman::orderBy('id', 'desc')->first();
        foreach ($pinjam as $sku) {
                // echo $sku;
            $tambah = peminjaman::
                where('id_mobil', $id)->where('id', $sku)->where(function ($query) {
            $query->whereDate('tanggal_mulai', '<=', request('tgl_kembali'))->whereDate('tanggal_selesai', '>=',request('tgl_kembali'))
            
                ->orwhereDate('tanggal_mulai', '<=', request('tgl_pinjam'))->whereDate('tanggal_selesai', '>=', request('tgl_pinjam'));
        })->first();
        if (is_null($tambah)){ 
            $data =  (int)$data + (int)0 ;
            // dd($data);
        }
        else {
        $data = (int)$data + (int)1;
        }
        
    };
    // dd($data);

        if ($data == 0){ 
            
            $car = mobil::find($id);
            $item = new peminjaman;
            $item->id_user = Auth::id();
            $item->id_mobil = $id;
            $item->tanggal_mulai  = Carbon::parse($request->tgl_pinjam);
            $item->tanggal_selesai   = Carbon::parse($request->tgl_kembali);
            $days = $item->tanggal_mulai->diffInDays($item->tanggal_selesai);
            $item->total_biaya = $days* $car->tarif_harian;
            $item->status = "Dipinjam";
            $item->save();
            $car->save();
            
        return redirect('mobil/pengembalian');
        }
        else {
            // dd($last_record->id);
            $data1["mobil"] = mobil::all(); 
            $data2["tanggal"] = [
                'tgl_pinjam'  => $request->tgl_pinjam,
                'tgl_kembali'   => $request->tgl_kembali
            ];
            $tgl_pinjam  = $request->tgl_pinjam;
            $tgl_kembali   = $request->tgl_kembali;
            //  dd ($data2);
            
            return view("pinjam.index",$data1,compact('tgl_pinjam','tgl_kembali'))->with('message', 'Mobil yang anda pilih tidak tersedia pada tanggal yang anda pilih');

        }

    //     $car = mobil::find($id);
    //     $item = new peminjaman;
    //     $item->id_user = Auth::id();
    //     $item->id_mobil = $id;
    //     $item->tanggal_mulai  = Carbon::parse($request->tgl_pinjam);
    //     $item->tanggal_selesai   = Carbon::parse($request->tgl_kembali);
    //     $days = $item->tanggal_mulai->diffInDays($item->tanggal_selesai);
    //     $item->total_biaya = $days* $car->tarif_harian;
    //     $item->status = "Dipinjam";
    //     $item->save();
    //     $car->save();
        
    // return redirect('mobil/pengembalian');
        
    }

    /**
     * Display the specified resource.
     */
    public function pengembalian(peminjaman $peminjaman)
    {
        $data["mobil"] = peminjaman::with('dipinjam')->where('id_user', Auth::id())->orderBy('id', 'desc')->get();
        
 
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
    public function kembali(Request $request, peminjaman $peminjaman)
    {
        $car = mobil::with('dipinjam')->where('no_plat', $request->no_plat)->pluck('id');

            peminjaman::with('dipinjam')
            ->where('id_mobil',$car)->where('id_user',Auth::id())->where('status',"dipinjam")->first()->update(['status' => 'Dikembalikan']);

        return redirect('mobil/pengembalian');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(peminjaman $peminjaman)
    {
        //
    }
}
