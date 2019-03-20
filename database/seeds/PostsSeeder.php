<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
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
        for ($i=1; $i<=40; $i++){
            $data[] = [
                'name' => 'Вакансия #'.$i,
                'departament_id' => random_int(1,10),
            ];
        }

        \DB::table('posts')->insert($data);
    }
}
