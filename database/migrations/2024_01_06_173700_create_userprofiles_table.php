<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userprofiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');

            $table->string('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('gender')->nullable();

            $table->date('date_of_birth')->nullable();
            $table->text('address')->nullable();
            $table->text('bio')->nullable();
            $table->string('department')->nullable();
            $table->bigInteger('part')->nullable();
            $table->string('identity')->nullable();
            $table->date('date_of_issue_identity')->nullable();
            $table->date('place_of_issue_identity')->nullable();
            $table->date('start_working_date')->nullable();
            $table->string('contract_id')->nullable();
            $table->date('end_working_date')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('avatar')->nullable();
            $table->text('user_metadata')->nullable();
            $table->string('last_ip')->nullable();
            $table->integer('login_count')->default(0);
            $table->timestamp('last_login')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->default(1)->unsigned();

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userprofiles');
    }
};
