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
        Schema::create('stage_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('stage_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('product_id')->references(columns: 'id')->on('products')->onDelete('cascade');
            $table->foreign('stage_id')->references(columns: 'id')->on('stages')->onDelete('cascade');
            $table->foreign('user_id')->references(columns: 'id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stage_users');
    }
};
