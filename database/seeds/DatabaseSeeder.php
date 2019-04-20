<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UsersTableSeeder::class);
        $this->call(DepartamentSeeder::class);
        $this->call(PostsSeeder::class);
//        factory(\App\Models\Application::class, 100)->create();
//        factory(\App\Models\Addiction::class, 200)->create();
        factory(User::class, 1)->create();
    }
}
