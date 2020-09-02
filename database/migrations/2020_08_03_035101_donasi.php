<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Donasi extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('donasis', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('nama_donatur');
      $table->string('nama_alias')->nullable();
      $table->string('alamat')->nullable();
      $table->bigInteger('total_donasi');
      $table->string('nama_bank')->nullable();
      $table->string('email')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    //
    Schema::dropIfExists('donasis');
  }
}
