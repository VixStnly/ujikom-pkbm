<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users'); // ID siswa
            $table->foreignId('subject_id')->constrained(); // ID mata pelajaran
            $table->foreignId('teacher_id')->constrained('users'); // ID guru yang mengisi nilai
            $table->integer('meeting'); // Pertemuan (menggantikan semester)
            $table->integer('score'); // Nilai
            $table->text('feedback')->nullable(); // Masukan atau saran untuk siswa
            $table->date('date')->nullable(); // Tanggal pengisian nilai
            $table->timestamps();

            // Menambahkan constraint unik untuk mencegah duplikasi nilai per pertemuan
            $table->unique(['student_id', 'subject_id', 'teacher_id', 'meeting']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}