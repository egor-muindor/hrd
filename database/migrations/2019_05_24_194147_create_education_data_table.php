<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('institution');
            $table->string('faculty');
            $table->string('formStudy');
            $table->string('admissionYear');
            $table->string('graduationYear');
            $table->string('graduationCourse');
            $table->string('specialty');
            $table->string('diploma');
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
        Schema::dropIfExists('education_data');
    }
}
