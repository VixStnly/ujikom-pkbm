<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryTable extends Migration
{
    public function up()
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->id();
            $table->string('image'); // Column for storing the image file path
            $table->timestamps(); // This will create created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('gallery');
    }
}
