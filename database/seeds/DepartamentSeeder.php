<?php

use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for ($i=0; $i<=10; $i++){
            $data[] = [
                'name' => 'Отдел #'.$i,
            ];
        }

        \DB::table('departaments')->insert($data);
    }
}
