<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbroadDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abroad_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sinceTime');
            $table->string('atTime');
            $table->string('country');
            $table->string('goal');
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
        Schema::dropIfExists('abroad_data');
    }
}
