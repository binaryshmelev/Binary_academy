<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookControllerTest extends TestCase
{
    public function testIndex()
    {
        $this->visit('/books');
        $this->see('The Lord of the Rings');
    }

    public function testCreate()
    {
        $this->visit('/books/create');
        $this->see('Create Book');
    }

    public function testStore()
    {
        $this->expectsJobs(App\Jobs\SendEmailNewBook::class);
        $this->visit('/books/create');
        $this->type('BookTest', 'title');
        $this->type('AuthorBook', 'author');
        $this->type('2012', 'year');
        $this->type('Fantasy', 'genre');
        $this->select('1', 'user_id');
        $this->press('Save');
        $this->seePageIs('/books');
        $this->see('Successfully created book');
    }

    /**
     * @dataProvider providerData
     */
    public function testStoreVersionTwo($author, $year, $title, $genre)
    {
        $response = $this->call('POST', '/books', array(
            'author' => $author,
            'year' => $year,
            'title' => $title,
            'genre' => $genre
        ));
        $this->assertTrue($response->isRedirection("/books"));
    }

    public function providerData()
    {
        return array (
            array('Peter Volfovich', 1996, 'The Book', 'Comedy'),
            array('Ivav Ivanovich', 2000, 'My Letter', 'Love')
        );
    }

    public function testStoreFalseTitle()
    {
        $this->visit('/books/create');
        $this->type('', 'title');
        $this->type('AuthorBook', 'author');
        $this->type('2012', 'year');
        $this->type('Fantasy', 'genre');
        $this->select('0', 'user_id');
        $this->press('Save');
        $this->see('The title field is required.');
    }

    public function testStoreFalseYear()
    {
        $this->visit('/books/create');
        $this->type('Book', 'title');
        $this->type('AuthorBook', 'author');
        $this->type('', 'year');
        $this->type('Fantasy', 'genre');
        $this->select('0', 'user_id');
        $this->press('Save');
        $this->see('The year field is required.');
    }

    public function testStoreFalseYearTwo()
    {
        $this->visit('/books/create');
        $this->type('Book', 'title');
        $this->type('AuthorBook', 'author');
        $this->type('abc', 'year');
        $this->type('Fantasy', 'genre');
        $this->select('0', 'user_id');
        $this->press('Save');
        $this->see('The year must be 4 digits.');
    }

    public function testStoreFalseAuthor()
    {
        $this->visit('/books/create');
        $this->type('Book', 'title');
        $this->type('', 'author');
        $this->type('2012', 'year');
        $this->type('Fantasy', 'genre');
        $this->select('0', 'user_id');
        $this->press('Save');
        $this->see('The author field is required.');
    }

    public function testStoreFalseGenre()
    {
        $this->visit('/books/create');
        $this->type('Book', 'title');
        $this->type('2012', 'year');
        $this->type('AuthorBook', 'author');
        $this->type('', 'genre');
        $this->select('0', 'user_id');
        $this->press('Save');
        $this->see('The genre field is required.');
    }

    public function testEdit()
    {
        $this->visit('/books/1/edit');
        $this->see('Edit book');
    }

    public function testUpdate()
    {
        $this->visit('/books/1/edit');
        $this->type('JRRTolkien', 'author');
        $this->select('1', 'user_id');
        $this->press('Save');
        $this->seePageIs('/books');
        $this->see('Successfully updated book');
    }

    public function testUpdateFalse()
    {
        $this->visit('/books/1/edit');
        $this->type('abs', 'year');
        $this->press('Save');
        $this->seePageIs('/books/1/edit');
        $this->see('The year must be 4 digits.');
    }

    public function testGiveBack()
    {
        $this->visit('/books/1/edit');
        $this->press('Give back');
        $this->seePageIs('/books');
        $this->see('Successfully return Book with ID:1');
    }

    public function testDestroy()
    {
        $response = $this->call('POST', '/books/2', array('_method'=>'DELETE'));
        $this->assertTrue($response->isRedirection("/books"));

    /*  // Another variant to test
        $this->visit('/books');
        $this->press('Delete Book');
        $this->seePageIs('/books');
        $this->see('Successfully deleted book');
    */

    }
}
