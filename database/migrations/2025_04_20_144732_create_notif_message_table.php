<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notif_message', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // user yang menerima notifikasi
            $table->string('type'); // 'forum_created' atau 'forum_liked'
            $table->json('data'); // data detail notifikasi
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notif_message');
    }
};
