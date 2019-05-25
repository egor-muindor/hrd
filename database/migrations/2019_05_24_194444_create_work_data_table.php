<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('entry');
            $table->text('exit');
            $table->text('position');
            $table->text('location');
            $table->unsignedBigInteger('candidate_id');

            $table->foreign('candidate_id')->references('id')->on('applications');

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
        Schema::dropIfExists('work_data');
    }
}