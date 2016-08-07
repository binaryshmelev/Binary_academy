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
        $genre = ['Fantasy', 'Comedy', 'Love'];
        $faker = Faker::create();

        //First record for TestCase
        DB::table('books')->insert([
            'title' => 'The Lord of the Rings',
            'author' => 'Tolkien',
            'year' => 1954,
            'genre' => $genre[0],
            'user_id' => 0,
        ]);

        foreach (range(2,$count_books) as $index) {
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
