<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Book;
use App\Http\Requests\UserRequest;
use App\Jobs\SendEmailReminder;

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
        return view('user/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->save();

        Session::flash('message', 'Successfully created user');
        return Redirect::to('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::findOrFail($id)->books()->paginate(10);
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
        $users = User::findOrFail($id);
        return view('user/edit',array('user'=>$users));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $rules['email'] = 'required|email|unique:users,email,' . $id;

        if (!empty($request->book)) {
            $rules['book'] = 'exists:books,id';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('users.edit', ['id' => $id])
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

                if (!empty($id)) {
                    $job_reminder = (new SendEmailReminder($book->id, $id, $user->email))->delay(2592000);
                    $this->dispatch($job_reminder);
                }
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
        $user = User::findOrFail($id);
        $user->delete();

        Session::flash('message', 'Successfully deleted user');
        return Redirect::to('users');
    }
}
