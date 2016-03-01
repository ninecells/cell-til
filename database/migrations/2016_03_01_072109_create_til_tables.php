<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTilTables extends Migration
{
    public function up()
    {
        Schema::create('til_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('writer_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('til_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->index();
            $table->string('title');
            $table->longText('content');
            $table->integer('writer_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('til_categories');
        Schema::drop('til_posts');
    }
}
