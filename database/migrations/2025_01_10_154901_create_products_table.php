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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->unsignedBigInteger('group_management');
            $table->foreign('group_management')->references('id')->on('groups')->onDelete('cascade');
            $table->integer('number_of_employees');
            $table->integer('time_to_complete');
            $table->integer('time_each_employee');
            $table->decimal('average_productivity', 10, 2);
            $table->decimal('average_productivity_each_employee', 10, 2);
            $table->decimal('total_time', 10, 2);
            $table->timestamps();
            $table->unique(['id', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
