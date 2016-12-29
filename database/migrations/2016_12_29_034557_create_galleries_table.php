<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleriesTable extends Migration
{
   
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // Create table for storing roles
        Schema::create('gallery_cats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('params')->nullable()->comment('save others data as json');
            $table->timestamps();
        });

        Schema::create('gallery_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 25)->comment("image or video");
            $table->string('title', 255);
            $table->string('image', 255);
            $table->tinyInteger("published")->unsigned();
            $table->integer("cat_id")->unsigned();
            $table->integer("ordering")->unsigned();
            $table->text('params')->nullable()->comment('save others data as json');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('gallery_cats');
        Schema::drop('gallery_items');
    }
}
