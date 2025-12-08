<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('UserID');
            $table->string('Username', 50)->unique();
            $table->string('Password');
            $table->string('Email', 100)->unique();
            $table->string('NamaLengkap', 100);
            $table->text('Alamat')->nullable();
            $table->enum('Role', ['admin', 'user'])->default('user');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
