<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\BookRequest;
use App\Book;
use App\User;
use App\Jobs\SendEmailNewBook;
use App\Jobs\SendEmailReminder;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $books = Book::paginate(10);
        return view('book/index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::all();
        $all_users = [0 => 'Free'];

        foreach($users as $user) {
            $all_users[] = $user->firstname;
        }

        return view('book/create', ['users' => $all_users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest|Request $request
     * @return Response
     */
    public function store(BookRequest $request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->year = $request->year;
        $book->author = $request->author;
        $book->genre = $request->genre;
        $book->user_id = $request->user_id;
        $book->save();

        $users = User::all();
        foreach ($users as $user) {
            $message = 'We have a new book [' . $book->title .'], welcome to get it!';
            $title = 'New book';
            $this->dispatch((new SendEmailNewBook($user->email, $message, $title)));
        }

        Session::flash('message', 'Successfully created book');
        return Redirect::to('books');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $users = User::all();
        $all_users = [0 => 'Free'];

        foreach($users as $user) {
            $all_users[] = $user->firstname;
        }

        return view('book/edit',['book'=> $book, 'users' => $all_users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BookRequest $request, $id)
    {
        $book = Book::find($id);

        if ($request['_action'] == 'remove') {
            $book->user_id = null;
            $book->save();

            Session::flash('message', 'Successfully return Book with ID:' .$book->id);
            if (isset($request['_from']) && $request['_from'] = 'edit') {
                return Redirect::to('books/');
            } else {
                return back();
            }
        }

        if ($request['_action'] == 'edit') {
            $book->title = $request->title;
            $book->year = $request->year;
            $book->author = $request->author;
            $book->genre = $request->genre;
            $book->user_id = $request->user_id;
            $book->save();

            if (!empty($request->user_id)) {
                $user = User::findOrFail($request->user_id);
                $job_reminder = (new SendEmailReminder($book->id, $request->user_id, $user->email))->delay(2592000);
                $this->dispatch($job_reminder);
            }

            Session::flash('message', 'Successfully updated book');
            return Redirect::to('books/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        Session::flash('message', 'Successfully deleted book');
        return Redirect::to('books');
    }
}
