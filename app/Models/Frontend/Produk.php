<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public $table = "produks";

    public function produk()
    {
        return $this->hasMany('App\Models\gambar_detail');
    }
   
}

