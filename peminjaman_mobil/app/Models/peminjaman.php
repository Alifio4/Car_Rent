<?php

namespace App\Models;


use App\Models\User;
use App\Models\mobil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjamen';
    protected $primarykey = 'id';
    protected $fillable = [
        'id_user',
        'id_mobil',
        'tanggal_mulai',
        'tanggal_selesai',
        'tarif_harian',
        'status',

    ];
    
    public function peminjam(){
        return $this->belongsTo(User::class, 'id_user');
    }
    public function dipinjam(){
        return $this->belongsTo(mobil::class, 'id_mobil');
    }
}
