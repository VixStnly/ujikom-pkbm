<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_face_photo_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacePhotoToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('face_photo')->nullable(); // Kolom untuk menyimpan foto wajah
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('face_photo');
        });
    }
}
