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
        Schema::table('stage_users', function (Blueprint $table) {
            $table->unsignedBigInteger('group_stage_id')->nullable()->after('user_id');
            $table->unsignedBigInteger('total')->nullable()->after('group_stage_id');
        });
    }

    public function down()
    {
        Schema::table('stage_users', function (Blueprint $table) {
            $table->dropColumn(['group_stage_id', 'total']);
        });
    }
};
