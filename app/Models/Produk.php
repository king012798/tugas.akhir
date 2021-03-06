<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pembelian;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pembelian(){
        return $this->hasMany(Pembelian::class,'id_produk');
    }
}
