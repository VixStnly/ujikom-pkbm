<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Menambahkan kolom 'meeting_id' yang mengacu pada tabel meetings
            $table->foreignId('meeting_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Menghapus kolom 'meeting_id' jika migration dibatalkan
            $table->dropForeign(['meeting_id']);
            $table->dropColumn('meeting_id');
        });
    }
};
