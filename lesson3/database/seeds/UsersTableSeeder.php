<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $count_users = 20;

        for ($i = 0; $i < $count_users; $i++) {
            DB::table('users')->insert([
                'firstname' => 'firstname_user#' . ($i + 1),
                'lastname' => 'lastname_user#' . ($i + 1),
                'email' => 'user' . ($i + 1) . '@example.com',
            ]);
        }
    }
}
