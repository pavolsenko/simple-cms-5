<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogpostblogcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post_blog_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_post_id')->unsigned();
            $table->integer('blog_category_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('blog_post_blog_category', function (Blueprint $table) {
            $table->foreign('blog_post_id')->references('id')->on('blog_post')->onDelete('cascade');
            $table->foreign('blog_category_id')->references('id')->on('blog_category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_post_blog_category');
    }
}
