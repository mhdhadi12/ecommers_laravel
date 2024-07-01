<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode',
        'nama',
        'id_satuan',
        'id_kategori',
        'saldoawal',
        'hargajual',
        'tglexp',
        'hargamodal',
        'foto',
        'deskripsi',
        'pajang',
        'saldoakhir',
    ];

    public function satuan(){
        return $this->belongsTo(Ssatuan::class);
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
