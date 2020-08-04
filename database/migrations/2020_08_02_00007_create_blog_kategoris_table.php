<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogKategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_kategoris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('kategori_id');
            $table->timestamps();
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_kategoris');
    }
}
