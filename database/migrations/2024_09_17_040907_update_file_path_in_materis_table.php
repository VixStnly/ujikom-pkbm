<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('materis', function (Blueprint $table) {
            $table->string('file_path')->nullable()->change(); // Menyesuaikan tipe data menjadi VARCHAR
        });
    }

    public function down()
    {
        Schema::table('materis', function (Blueprint $table) {
            $table->text('file_path')->nullable()->change(); // Mengembalikan ke TEXT jika diperlukan
        });
    }

};
