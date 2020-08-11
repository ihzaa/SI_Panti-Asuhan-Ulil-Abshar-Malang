<?php

use App\Models\Frontend\ProfilAnak;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnakAsuhSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    $users = factory(ProfilAnak::class, 10)->create();
  }
}
