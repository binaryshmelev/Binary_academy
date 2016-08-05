@extends('app')

@section('pagetitle')
    Books List
@stop

@section('content')
    @if (count($books) > 0)
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Title</td>
                <td>Author</td>
                <td>Year</td>
                <td>Genre</td>
                <td>Users</td>
                <td width="250">Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->year }}</td>
                    <td>{{ $book->genre }}</td>
                    <td>
                        @if ($book->user_id)
                            <a class="btn btn-small btn-default" href="{{ URL::to('users/' . $book->user->id) }}" title="Edit this book">{{$book->user->firstname}} {{$book->user->lastname}}</a>
                        @else
                            Free
                        @endif
                    <td>
                        <a class="btn btn-small btn-info" href="{{ URL::to('books/' . $book->id . '/edit') }}" title="Edit this book">Edit this book</a>

                        {!! Form::open(['url'=>'books/'. $book->id, 'class'=>'pull-right']) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::submit('Delete Book', ['class'=> 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    {!! $books->render() !!}
    @else
        No records..
    @endif
@stop