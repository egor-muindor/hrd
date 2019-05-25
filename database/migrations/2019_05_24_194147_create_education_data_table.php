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
            $table->text('institution');
            $table->text('faculty');
            $table->text('formStudy');
            $table->text('admissionYear');
            $table->text('graduationYear');
            $table->text('graduationCourse');
            $table->text('specialty');
            $table->text('diploma');
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
