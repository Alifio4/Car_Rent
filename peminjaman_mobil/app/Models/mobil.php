<?php

namespace App\Models;

use App\Models\peminjaman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class mobil extends Model
{
    use HasFactory;
    protected $table = 'mobils';
    protected $primarykey = 'id';
    protected $fillable = [
        'merk',
        'model',
        'no_plat',
        'tanggal_mulai',
        'tanggal_selesai',
        'tarif_harian',
        'ketersediaan',
    ];

    public function dipinjam(){
        return $this->hasMany(peminjaman::class, 'id_mobil', 'id');
    }

}
