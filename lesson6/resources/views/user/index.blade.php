@extends('app')

@section('pagetitle')
    Users List
@stop

@section('content')
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Fisrtname</td>
            <td>Lasttname</td>
            <td>Email</td>
            <td>Books</td>
            <td width="355">Actions</td>
        </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if(count($user->books) > 0)
                                @foreach($user->books as $book)
                                    <a style="float:left" class="btn btn-small btn-default" href="{{ URL::to('books/' . $book->id) }}">{{$book->title}}</a>

                                    {!! Form::open(['url'=>'books/'. $book->id , 'style'=>'float:left; margin:2px; margin-right:10px']) !!}
                                    {!! Form::hidden('_method', 'PATCH') !!}
                                    {!! Form::hidden('_action', 'remove') !!}
                                    {!! Form::button('<i class="glyphicon glyphicon-remove"></i>',
                                                      ['title' => 'Give back this book', 'type' => 'submit', 'class' => 'btn btn-sm btn-delete']) !!}
                                    {!! Form::close() !!}
                                @endforeach
                        @else
                            No books
                        @endif

                    </td>
                    <td>
                        <a class="btn btn-small btn-success" href="{{ URL::to('users/' . $user->id) }}" title="Show this user">Show this user</a>
                        <a class="btn btn-small btn-info" href="{{ URL::to('users/' . $user->id . '/edit') }}" title="Edit this user">Edit this user</a>

                        {!! Form::open(['url'=>'users/'. $user->id, 'class'=>'pull-right']) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::submit('Delete User', ['class'=> 'btn btn-danger']) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $users->render() !!}
@stop