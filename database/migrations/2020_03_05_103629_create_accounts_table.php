<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('google_account_id')->nullable();
            $table->string('facebook_account_id')->nullable();
            $table->string('email');
            $table->string('password')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();

            // constraint
            $table->foreign('user_id')->references('id')->on('users');
            $table->unique('email');
            $table->unique('google_account_id');
            $table->unique('facebook_account_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
