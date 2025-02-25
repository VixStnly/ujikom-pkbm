<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToTugasTable extends Migration
{
    public function up()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->string('status')->default('pending'); // Tambahkan kolom status dengan nilai default 'pending'
        });
    }

    public function down()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropColumn('status'); // Hapus kolom status saat rollback
        });
    }
}
