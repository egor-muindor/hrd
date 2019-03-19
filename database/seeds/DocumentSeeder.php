<?php

use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $data = [];

        for ($i = 1; $i<= 100; $i++){
            $data[] = [
                'application_id' => $i,
                'passport_id' => random_int(1000, 9999).' '.random_int(100000, 999999), // faker сломался ну или я тупенький >_<
                'employment_history' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'snils' => random_int(100, 999) . '-' . random_int(100, 999) . '-' . random_int(100, 999) . '-' . random_int(10, 99),
                'inn' => '' . random_int(1000000000, 9999999999),
                'test_data' => random_bytes(10),
            ];
        }

        \DB::table('documents')->insert($data);
    }
}
/**
 * $table->unsignedBigInteger('application_id');
 * $table->text('passport_id');
 * $table->text('employment_history'); // пока так, нужно будет приделать доп таблицу
 * $table->text('snils');
 * $table->text('inn');
 * $table->binary('test_data');
 * $table->timestamps();
 * $table->softDeletes();
 */

