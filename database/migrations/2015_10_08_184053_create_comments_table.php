<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_post_id')->unsigned();
            $table->integer('reply_to_id')->unsigned()->nullable();
            $table->integer('comment_author_id')->unsigned();
            $table->string('text');
            $table->integer('status');
            $table->string('ip_address')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('comment_author', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('ip_address')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('comment', function (Blueprint $table) {
            $table->foreign('comment_author_id')->references('id')->on('comment_author')->onDelete('cascade');
            $table->foreign('blog_post_id')->references('id')->on('blog_post')->onDelete('cascade');
            $table->foreign('reply_to_id')->references('id')->on('comment')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
        Schema::dropIfExists('comment_author');
    }
}
