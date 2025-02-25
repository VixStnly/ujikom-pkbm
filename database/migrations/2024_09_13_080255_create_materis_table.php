<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterisTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('file_path')->nullable(); // Untuk menyimpan file materi
            $table->unsignedBigInteger('guru_id'); // ID guru yang mengunggah materi
            $table->unsignedBigInteger('course_id'); // ID kursus terkait
            $table->timestamps();

            // Foreign key untuk guru
            $table->foreign('guru_id')->references('id')->on('users')->onDelete('cascade');

            // Foreign key untuk kursus
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('materis');
    }
}
