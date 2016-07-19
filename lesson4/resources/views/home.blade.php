@extends('layouts/app')

@section('pagetitle')
    Profile
@stop

@section('content')

    <table class="table table-striped table-bordered">
        <tbody>
        <tr>
            <td><b>ID:</b></td>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <td><b>Firstname:</b></td>
            <td>{{ $user->firstname }}</td>
        </tr>
        <tr>
            <td><b>Lastname:</b></td>
            <td>{{ $user->lastname }}</td>
        </tr>
        <tr>
            <td><b>Email:</b></td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td><b>Books:</b></td>
            <td>
                <ul>
                    @foreach($user->books as $book)
                        <li>{!! $book->title !!}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        </tbody>
    </table>

    <a class="btn btn-sm btn-primary" href="{{ URL::to('users/' . $user->id . '/edit') }}">Edit</a>
@stop