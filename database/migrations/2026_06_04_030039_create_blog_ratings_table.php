<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('blog_ratings', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('rate')->unsigned()->comment('1-5 stars');
            $table->unsignedBigInteger('id_blog');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_blog')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_ratings');
    }
}