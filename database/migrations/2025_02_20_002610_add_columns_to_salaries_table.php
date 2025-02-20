<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('salaries', function (Blueprint $table) {
            // Thêm các cột vào bảng salaries
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Thêm cột user_id với khóa ngoại tới bảng users
            $table->integer('month'); // Cột tháng
            $table->integer('year');  // Cột năm
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salaries', function (Blueprint $table) {
            // Xóa các cột khi rollback migration
            $table->dropColumn(['user_id', 'month', 'year']);
        });
    }
};
