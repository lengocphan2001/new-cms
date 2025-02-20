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
        Schema::create('salary_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salary_id'); // Reference to the salary
            $table->decimal('allowance', 10, 2)->default(0); // Phụ cấp
            $table->decimal('allowances', 10, 2)->default(0); // Tiền ăn, xăng xe, chuyên cần
            $table->decimal('product_salary', 10, 2)->default(0); // Lương sản phẩm
            $table->decimal('deductions', 10, 2)->default(0); // Phạt (nếu có)
            $table->decimal('total_salary', 10, 2)->default(0); // Tổng lương
            $table->timestamps();

            // Foreign key constraint to ensure that salary_id exists in the salaries table
            $table->foreign('salary_id')->references('id')->on('salaries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_details');
    }

};
