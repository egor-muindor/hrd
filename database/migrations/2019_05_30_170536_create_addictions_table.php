<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addictions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('application_id');
            $table->text('description');
            $table->text('file');
            $table->timestamps();

            $table->foreign('application_id')->references('id')->on('applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addictions');
    }
}
