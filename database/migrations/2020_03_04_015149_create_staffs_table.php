<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->text('address');
            $table->string('city');
            $table->string('email');
            $table->string('password');
            $table->timestamp('last_login_at');
            $table->unsignedBigInteger('branch_office_id');
            $table->timestamps();

            // constraint
            $table->foreign('branch_office_id')->references('id')->on('branch_offices');
            $table->unique('email');
            $table->unique('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
}
