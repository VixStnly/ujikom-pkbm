<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('absensi', function (Blueprint $table) {
            // Menambahkan kolom foto sebagai string (path ke gambar)
            $table->string('foto')->nullable()->after('status');
            
            // Menambahkan kolom latitude dan longitude
            $table->decimal('latitude', 10, 7)->nullable()->after('foto');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('absensi', function (Blueprint $table) {
            $table->dropColumn(['foto', 'latitude', 'longitude']);
        });
    }
};