<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('candidate_id');
            $table->string('Surname');
            $table->string('Name');
            $table->string('Patronymic');
            $table->string('Sex');
            $table->string('Birthday');
            $table->string('Birthplace');
            $table->string('Languages');
            $table->string('AcademicDegree');
            $table->string('ScientificWork');
            $table->string('MilitaryRank');
            $table->string('MilitaryComposition');
            $table->string('MilitaryBranch');
            $table->string('HomeAddress');
            $table->string('Phone');
            $table->string('PassportSeries');
            $table->string('PassportNumber');
            $table->string('PassportGiven');
            $table->string('Inn');
            $table->string('Pfr');
            $table->longText('Biography');
            $table->string('avatar')->nullable();
            $table->string('email')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('candidate_id')->references('id')->on('candidates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
