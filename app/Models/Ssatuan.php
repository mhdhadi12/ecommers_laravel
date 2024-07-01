<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ssatuan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
    ];

    public function stok(){
        return $this->hasOne(Stok::class);
    }
}
