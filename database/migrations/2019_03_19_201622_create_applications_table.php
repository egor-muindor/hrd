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
            $table->text('first_name');                         // Имя
            $table->text('middle_name');                        // Отчество
            $table->text('last_name');                          // Фамилия
            $table->unsignedBigInteger('post_id');              // Номер должности
            $table->text('passport_id');                        // Серия и номер паспорта. Храняться в виде: "0000 000000"
            $table->mediumText('employment_history');           // Предыдущие места работы
            $table->text('snils');                              // СНИЛС
            $table->text('inn');                                // ИНН
            $table->mediumtext('scientific_works');             // Научные труды
            $table->text('email');                              // Email

            // Далее поля заполняются при проверке
            $table->smallInteger('status')->default(0);
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
