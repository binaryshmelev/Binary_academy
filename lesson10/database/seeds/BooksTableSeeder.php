<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->delete();
        $count_books = 25;
        $count_users = 20;
        $genre = ['Fantastic', 'Comedy', 'Love'];
        $faker = Faker::create();

        foreach (range(1,$count_books) as $index) {
            DB::table('books')->insert([
                'title' => $faker->word,
                'author' => $faker->name,
                'year' => $faker->year,
                'genre' => $genre[random_int(0,2)],
                'user_id' => random_int(0,$count_users),
            ]);
        }
    }
}
