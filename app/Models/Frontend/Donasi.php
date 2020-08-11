<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
  //
  protected $table = 'donasis';
  protected $fillable = ['nama_donatur', 'nama_alias', 'total_donasi', 'nama_bank'];
}
