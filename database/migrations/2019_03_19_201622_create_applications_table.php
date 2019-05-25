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
            $table->text('Surname');
            $table->text('Name');
            $table->text('Patronymic');
            $table->text('Sex');
            $table->text('Birthday');
            $table->text('Birthplace');
            $table->text('Languages');
            $table->text('AcademicDegree');
            $table->text('ScientificWork');
            $table->text('MilitaryRank');
            $table->text('MilitaryComposition');
            $table->text('MilitaryBranch');
            $table->text('HomeAddress');
            $table->text('Phone');
            $table->text('PassportSeries');
            $table->text('PassportNumber');
            $table->text('PassportGiven');
            $table->text('Inn');
            $table->text('Pfr');
            $table->longText('Biography');

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
        Schema::dropIfExists('applications');
    }
}
