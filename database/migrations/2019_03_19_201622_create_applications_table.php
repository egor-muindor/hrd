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
            $table->text('first_name');
            $table->text('middle_name');
            $table->text('last_name');
            $table->text('email');
            $table->unsignedBigInteger('post_id');
            $table->smallInteger('status')->default(0);
            $table->text('passport_id');
            $table->mediumText('employment_history'); // пока так, нужно будет приделать доп таблицу
            $table->text('snils');
            $table->text('inn');
            $table->text('data_token');
            $table->mediumText('description')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('post_id')->references('id')->on('posts');
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
