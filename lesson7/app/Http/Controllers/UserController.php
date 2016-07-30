<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\User;
use App\Book;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try{
            $user = User::find($id);
            $code = 200;

            if (empty($user)) {
                $message = 'User was not found';
            } else {
                    $message = $user;
            }
        }catch (\Exception $e){
            $code = 500;
            $message = 'Error with API: ' . $e->getMessage();
        }finally{
            return Response::json($message, $code);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        try{
            $user = User::all();
            $code = 200;

            if (empty($user)) {
                $message = 'User was not found';
            } else {
                $message = $user;
            }
        }catch (\Exception $e){
            $code = 500;
            $message = 'Error with API: ' . $e->getMessage();
        }finally{
            return Response::json($message, $code);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userbooks($id)
    {
        try{
            $user = User::find($id);
            $code = 200;

            if (empty($user)) {
                $message = 'User was not found';
            } else {
                $message = $user->books()->paginate();
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $user = User::find($id);

            if (empty($user)) {
                $message = 'User was not found';
            } else if (!empty($request->book)) {
                    $rules = ['book' => 'exists:books,id'];
                    $validator = Validator::make($request->all(), $rules);

                    if ($validator->fails()) {
                        $code = 406;
                        $message = $validator->messages();
                    } else {
                        $book = Book::find($request->book);
                        $book->user_id = $id;
                        $book->save();
                        $code = 200;
                        $message = 'Successfully added Book';
                    }
            } else {
                $code = 404;
                $message = 'Book was not found';
            }
        }catch (\Exception $e){
            $code = 500;
            $message = 'Error with API: ' . $e->getMessage();
        }finally{
            return Response::json($message, $code);
        }
    }
}
