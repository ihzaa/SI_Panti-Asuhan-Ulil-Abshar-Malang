<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class ProfilAnak extends Model
{
  protected $table = 'profil_anaks';
  protected $fillable = ['nama',  'alamat_asal', 'foto_path', 'jenis_kelamin', 'umur', 'sekolah', 'kelas'];
}
