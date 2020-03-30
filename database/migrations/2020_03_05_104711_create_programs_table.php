<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('location');
            $table->integer('amount');
            $table->text('featured_image');
            $table->string('status');
            $table->unsignedBigInteger('branch_office_id');
            $table->unsignedBigInteger('admin_id');
            $table->timestamps();

            // constraint
            $table->foreign('branch_office_id')->references('id')->on('branch_offices');
            $table->foreign('admin_id')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
