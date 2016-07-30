<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $books = Book::all();
            $code = 200;

            if (empty($books)) {
                $message = 'Books was not found';
            } else {
                $message = $books;
            }
        }catch (\Exception $e){
            $code = 500;
            $message = 'Error with API: ' . $e->getMessage();
        }finally{
            return Response::json($message, $code);
        }
    }

    /**
     * Display details of the book
     *
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        try{
            $book = Book::find($id);

            if (!empty($book->user_id)) {
                $book->user = $book->user()->find($book->user_id)->firstname . ' ' . $book->user()->find($book->user_id)->lastname;
            }

            if (empty($book)) {
                $code = 404;
                $message = 'Book was not found';
            } else {
                $code = 200;
                $message = $book;
            }
        }catch (\Exception $e){
            $code = 500;
            $message = 'Error with API: ' . $e->getMessage();
        }finally{
            return Response::json($message, $code);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'title' => 'required',
                'year' => 'required|digits:4',
                'author' => 'required',
                'genre' => 'required',
                'user_id' => 'exists:users,id',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = 406;
                $message = $validator->messages();
            } else {
                $book = new Book();
                $book->title = $request->title;
                $book->year = $request->year;
                $book->author = $request->author;
                $book->genre = $request->genre;
                $book->user_id = $request->user_id;
                $book->save();
                $code = 201;
                $message = $book;
            }
        } catch (\Exception $e){
            $code = 500;
            $message = 'Error with API: ' . $e->getMessage();
        } finally{
            return Response::json($message, $code);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        try{
            $book = Book::find($id);

            if (empty($book)) {
                $code = 404;
                $message = 'Book was not found';
            } else {
                $book->user_id = null;
                $book->save();
                $code = 200;
                $message = 'Successfully return Book with ID:' .$book->id;
            }
        }catch (\Exception $e){
            $code = 500;
            $message = 'Error with API: ' . $e->getMessage();
        }finally{
            return Response::json($message, $code);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        try{
            $book = Book::find($id);

            if (empty($book)) {
                $code = 404;
                $message = 'Book was not found';
            } else {
                $book->title = $request->title;
                $book->year = $request->year;
                $book->author = $request->author;
                $book->genre = $request->genre;
                $book->user_id = $request->user_id;
                $book->save();
                $code = 200;
                $message = 'Successfully edit Book with ID:' .$book->id;
            }
        }catch (\Exception $e){
            $code = 500;
            $message = 'Error with API: ' . $e->getMessage();
        }finally{
            return Response::json($message, $code);
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
        try{
            $book = Book::find($id);

            if (empty($book)) {
                $code = 404;
                $message = 'Book was not found';
            } else {
                $book->delete();
                $code = 200;
                $message = 'Successfully deleted book with ID:' .$book->id;
            }
        }catch (\Exception $e){
            $code = 500;
            $message = 'Error with API: ' . $e->getMessage();
        }finally{
            return Response::json($message, $code);
        }
    }
}
