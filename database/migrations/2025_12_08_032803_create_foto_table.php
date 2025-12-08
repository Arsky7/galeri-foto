<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foto', function (Blueprint $table) {
            $table->id('FotoID');
            $table->string('JudulFoto', 100);
            $table->text('DeskripsiFoto')->nullable();
            $table->date('TanggalUnggah');
            $table->string('LokasiFile', 255);
            
            $table->unsignedBigInteger('AlbumID');
            $table->foreign('AlbumID')
                  ->references('AlbumID')
                  ->on('album')
                  ->onDelete('cascade');
            
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
        Schema::dropIfExists('foto');
    }
};