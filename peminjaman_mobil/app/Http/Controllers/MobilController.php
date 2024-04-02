<?php

namespace App\Http\Controllers;

use App\Models\mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $data["mobil"] = mobil::all(); 
 
    return view("index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("mobil/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'merk' => ['required','string', 'max:100'],
            'model' => ['required','string', 'max:100'],
            'no_plat' => ['required','string', 'max:100', 'unique:'.mobil::class],
            'tarif_harian' => ['required','integer'],
            
        ]);
            $item = new mobil;
            $item->merk = $request->merk;
            $item->model = $request->model;
            $item->no_plat = $request->no_plat;
            $item->tarif_harian = $request->tarif_harian;
            $item->ketersediaan = "tersedia";
            $item->save();
        
    
        return redirect('mobil');
    }
    public function search(Request $request)
	{
        $search = $request->search;
		$data["mobil"] = mobil::where('merk', 'like',"%".$search."%")
        ->get(); 
 
        return view("index",$data);
		
	}

    /**
     * Display the specified resource.
     */
    public function show(mobil $mobil)
    {
        $isBooked = DB::table('peminjaman')
    ->whereDate('$isBookedstarting_at', '<=', request('ending_date'))
    ->whereDate('ending_at', '>=', request('starting_date'))
    ->get('id_mobil');
    // dd ($isBooked)

return $isBooked ? 'yes' : 'no';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mobil $mobil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mobil $mobil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mobil $mobil)
    {
        //
    }
}
