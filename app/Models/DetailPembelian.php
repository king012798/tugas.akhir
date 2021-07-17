<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pembelian;

class DetailPembelian extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pembelian(){
        return $this->belongsTo(Pembelian::class, 'id_pembelian');
    }
}
