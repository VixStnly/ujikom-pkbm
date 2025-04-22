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
        Schema::table('notifications_guru', function (Blueprint $table) {
            $table->unsignedBigInteger('tugas_id')->after('user_id');
    
            $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('notifications_guru', function (Blueprint $table) {
            $table->dropForeign(['tugas_id']);
            $table->dropColumn('tugas_id');
        });
    }
    
};
