<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
  //
  protected $table = 'donasis';
  protected $fillable = ['created_at', 'nama_donatur', 'nama_alias', 'alamat', 'total_donasi', 'nama_bank', 'email'];
}
