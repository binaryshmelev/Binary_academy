<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Book;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('user/index', ['users' => $users]);
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

        return view('user/create');
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
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('users/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = new User();
            $user->firstName = $request->firstname;
            $user->lastName = $request->lastname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            Session::flash('message', 'Successfully created user');
            return Redirect::to('users');
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
        $users = User::find($id)->books()->paginate(10);
        return view('book/index', array('books'=>$users));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);

        if (Gate::denies('edit-profile', $users)) {
            abort(403, 'Unauthorized action.');
        }

        return view('user/edit',array('user'=>$users));
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
        $users = User::find($id);

        if (Gate::denies('edit-profile', $users)) {
            abort(403, 'Unauthorized action.');
        }

        $user = User::find($id);
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
        ];

        if (!empty($request->book)) {
            $rules['book'] = 'exists:books,id';
        }

        if ($request->email != $user->email){
            $rules['email'] = 'required|email|unique:users';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('users/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user->firstName = $request->firstname;
            $user->lastName = $request->lastname;
            $user->email = $request->email;
            $user->save();

            if ($request->book) {
                $book = Book::find($request->book);
                $book->user_id = $id;
                $book->save();
            }

            Session::flash('message', 'Successfully updated user');
            return Redirect::to('users/'. $id);
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

        $user = User::find($id);

        $books=$user->books();

        foreach ($books as $book){
            $booken = Book::find($book->id);
            $booken->user_id = 0;
            $booken->save();
        }

        $user->delete();

        Session::flash('message', 'Successfully deleted user');
        return Redirect::to('users');
    }
}
