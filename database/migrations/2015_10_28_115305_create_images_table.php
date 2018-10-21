<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('alt');
            $table->string('width');
            $table->string('height');
            $table->integer('created_by')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('featured_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('image_id')->unsigned();
            $table->integer('blog_post_id')->unsigned();
        });
        Schema::table('image', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('user');
        });
        Schema::table('featured_image', function (Blueprint $table) {
            $table->foreign('image_id')->references('id')->on('image')->onDelete('cascade');
            $table->foreign('blog_post_id')->references('id')->on('blog_post')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('featured_image');
        Schema::dropIfExists('image');
    }
}
