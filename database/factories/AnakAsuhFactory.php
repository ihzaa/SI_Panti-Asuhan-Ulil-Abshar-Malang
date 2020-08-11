<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Frontend\ProfilAnak;
use Faker\Generator as Faker;

$factory->define(ProfilAnak::class, function (Faker $faker) {
  return [
    'nama' => $faker->name,
    'foto_path' => '',
    'jenis_kelamin' => 0,
    'umur' => 20,
    'sekolah' => '-',
    'kelas' => '-'
  ];
});
