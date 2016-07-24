<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        for ($i = 0; $i < $count_books; $i++) {
            DB::table('books')->insert([
                'title' => 'Book#' . ($i + 1),
                'author' => 'Author book#' . ($i + 1),
                'year' => '20' . random_int(0,1) . random_int(0,6),
                'genre' => 'Genre book#' . ($i + 1),
                'user_id' => random_int(0,$count_users),
            ]);
        }
    }
}
