<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(10);
        return view('book/index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('isAdmin', Auth::user())) {
            abort(403, 'Unauthorized action.');
        }

        return view('book/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('isAdmin', Auth::user())) {
            abort(403, 'Unauthorized action.');
        }

        $rules = [
            'title' => 'required',
            'year' => 'required|digits:4',
            'author' => 'required|alpha',
            'genre' => 'required|alpha',
            'user_id' => 'exists:users,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('books/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $book = new Book();
            $book->title = $request->title;
            $book->year = $request->year;
            $book->author = $request->author;
            $book->genre = $request->genre;
            $book->user_id = $request->user_id;
            $book->save();

            Session::flash('message', 'Successfully created book');
            return Redirect::to('books');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('isAdmin', Auth::user())) {
            abort(403, 'Unauthorized action.');
        }

        $book = Book::find($id);
        return view('book/edit',['book'=> $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::denies('isAdmin', Auth::user())) {
            abort(403, 'Unauthorized action.');
        }

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
            $rules = [
                'title' => 'required',
                'year' => 'required|digits:4',
                'author' => 'required|alpha',
                'genre' => 'required|alpha',
                'user_id' => 'exists:users,id',
            ];

            $validator = Validator::make($request->all(),$rules);

            if ($validator->fails()) {
                return Redirect::to('books/' . $id . '/edit')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $book->title = $request->title;
                $book->year = $request->year;
                $book->author = $request->author;
                $book->genre = $request->genre;
                $book->user_id = $request->user_id;
                $book->save();

                Session::flash('message', 'Successfully updated book');
                return Redirect::to('books/');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('isAdmin', Auth::user())) {
            abort(403, 'Unauthorized action.');
        }

        $book = Book::find($id);
        $book->delete();

        Session::flash('message', 'Successfully deleted book');
        return Redirect::to('books');
    }
}
