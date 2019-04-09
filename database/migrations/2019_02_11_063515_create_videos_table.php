<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->mediumText('description')->nullable();
            $table->string('tag')->nullable();
            $table->string('country')->nullable();
            $table->string('video_link')->unique();
            $table ->integer('user_id')->unsigned()->index()->nullable();
            $table ->foreign('user_id')->references('id')->on('users');
            $table->string('view')->default('public');
            $table->string('video_file');
            $table->string('filename');
            $table->string('location')->nullable();
            $table->mediumText('thumbnail')->nullable();
            $table->string('format')->default('mp4');
            $table->string('duration')->nullable();
            $table->string('producer');
            $table->string('filesize')->nullable();
            $table->string('bitrate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
        $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('tag')->nullable();
            $table->string('country')->nullable()->default('nigeria');
            $table->string('link');
            $table->string('view')->default('public');
            $table->timestamps();
    }
}
