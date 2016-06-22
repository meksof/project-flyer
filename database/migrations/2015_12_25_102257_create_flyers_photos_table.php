<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlyersPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flyer_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('flyer_id')->unsigned();
            $table->string('path');
            $table->string('name');
            $table->string('thumbnail_path');



            $table->foreign('flyer_id')->references('id')->on('flyers')->onDelete('cascade');

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
        Schema::drop('flyer_photos');
    }
}
