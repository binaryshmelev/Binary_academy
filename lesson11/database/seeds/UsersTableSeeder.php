<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
        $faker = Faker::create();

        //First record for TestCase
        DB::table('users')->insert([
            'firstname' => 'Tester',
            'lastname' => 'Cases',
            'email' => 'tester@example.com',
        ]);

        foreach (range(2,$count_users) as $index) {
            DB::table('users')->insert([
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
            ]);
        }
    }
}
