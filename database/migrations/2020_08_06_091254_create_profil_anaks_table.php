<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilAnaksTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('profil_anaks', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('nama');
      $table->text('foto_path');
      $table->string('jenis_kelamin');
      $table->tinyInteger('umur');
      $table->string('sekolah');
      $table->string('kelas');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('profil_anaks');
  }
}
