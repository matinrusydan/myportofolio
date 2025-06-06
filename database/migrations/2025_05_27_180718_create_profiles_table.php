<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->text('description');
            $table->string('photo')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('github_url')->nullable();
            $table->string('whatsapp_url')->nullable();
            $table->string('telegram_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};