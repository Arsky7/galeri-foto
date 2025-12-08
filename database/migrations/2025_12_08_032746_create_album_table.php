<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('album', function (Blueprint $table) {
            $table->id('AlbumID');
            $table->string('NamaAlbum', 100);
            $table->text('Deskripsi')->nullable();
            $table->date('TanggalDibuat');
            
            $table->unsignedBigInteger('UserID');
            $table->foreign('UserID')
                  ->references('UserID')
                  ->on('users')
                  ->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('album');
    }
};