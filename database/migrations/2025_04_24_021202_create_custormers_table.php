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
        Schema::create('custormers', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Position');
            $table->enum('Status', ['Active', 'Inactive', 'Pending'])->default('Pending');
            $table->enum('Gender', ['Male', 'Female'])->nullable();
            $table->string('Email')->unique();
            $table->string('Avatar')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('custormers');
    }
};
