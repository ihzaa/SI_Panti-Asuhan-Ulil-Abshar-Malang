<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_fotos', function (Blueprint $table) {
            $table->id();
            $table->text('path');
            $table->unsignedBigInteger('blog_id');
            $table->timestamps();
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_fotos');
    }
}
