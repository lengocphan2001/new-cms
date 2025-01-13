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
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('group_stage');
            $table->foreign('group_stage')->references(columns: 'id')->on('stage_groups')->onDelete('cascade');
            $table->string('machine_type');
            $table->decimal('price', 10, 2);
            $table->integer('time_to_complete');
            $table->integer('number_of_employee');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
