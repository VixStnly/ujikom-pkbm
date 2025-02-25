<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKategoriIdToGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('galleries', function (Blueprint $table) {
        $table->unsignedBigInteger('kategori_id')->after('id')->nullable(); // Menambahkan kategori_id

        // Menambahkan foreign key constraint
        $table->foreign('kategori_id')->references('id')->on('kategori_galeri')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('galleries', function (Blueprint $table) {
        $table->dropForeign(['kategori_id']);
        $table->dropColumn('kategori_id');
    });
}

}
