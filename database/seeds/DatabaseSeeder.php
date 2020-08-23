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
        DB::table('telepons')->insert([
            "no_telp" => "+6287759721950",
            "key" => "471726"
        ]);
    }
}
