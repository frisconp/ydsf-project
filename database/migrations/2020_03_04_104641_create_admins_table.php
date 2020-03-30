<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->string('email');
            $table->string('password');
            $table->text('avatar')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('branch_office_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // constraint
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('branch_office_id')->references('id')->on('branch_offices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
