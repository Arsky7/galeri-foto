<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komentarfoto', function (Blueprint $table) {
            $table->id('KomentarID');
            
            $table->unsignedBigInteger('FotoID');
            $table->foreign('FotoID')
                  ->references('FotoID')
                  ->on('foto')
                  ->onDelete('cascade');
            
            $table->unsignedBigInteger('UserID');
            $table->foreign('UserID')
                  ->references('UserID')
                  ->on('users')
                  ->onDelete('cascade');
            
            $table->text('IsiKomentar');
            $table->date('TanggalKomentar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komentarfoto');
    }
};