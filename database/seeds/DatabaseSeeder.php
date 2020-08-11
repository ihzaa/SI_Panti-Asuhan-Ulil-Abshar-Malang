<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call(AnakAsuhSeeder::class);

    DB::table('roles')->insert([
      'nama' => 'admin'
    ]);
    DB::table('users')->insert([
      'username' => 'admin',
      'nama' => 'admin ganteng',
      'password' => Hash::make('123'),
      'role_id' => 1
    ]);

    DB::table('orphanages')->insert([
      'name' => 'Andika Putra S.',
      'grade' => '8',
      'origin' => 'Flores'
    ]);
    DB::table('orphanages')->insert([
      'name' => 'Ahmad Akbar K.',
      'grade' => '8',
      'origin' => 'Kediri'
    ]);
    DB::table('orphanages')->insert([
      'name' => 'Ade Muhamad Reni',
      'grade' => '8',
      'origin' => 'Pagelaran'
    ]);
    DB::table('orphanages')->insert([
      'name' => 'Afrijal Dwi Anugro.',
      'grade' => '9',
      'origin' => 'Malang'
    ]);
    DB::table('orphanages')->insert([
      'name' => 'Burhanudin',
      'grade' => '10',
      'origin' => 'Malang'
    ]);
  }
}
