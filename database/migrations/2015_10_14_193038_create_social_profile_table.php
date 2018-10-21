<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_social_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned();
            $table->string('type');
            $table->string('name')->nullable();
            $table->string('handle')->nullable();
            $table->string('link');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('author_social_profile', function (Blueprint $table) {
            $table->foreign('author_id')->references('id')->on('author')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('author_social_profile');
    }
}
