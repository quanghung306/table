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
        Schema::create('prodcuts', function (Blueprint $table) {
            $table->id();
            $table->string("ProductName");
            $table->string("Category");
            $table->string("Stock");
            $table->string("Price");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prodcuts');
    }
};
