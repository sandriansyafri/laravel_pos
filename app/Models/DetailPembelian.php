<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['produk'];
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}
