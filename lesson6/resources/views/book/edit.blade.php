@extends('app')

@section('pagetitle')
    Edit book
@stop


@section('content')
    {!! Html::ul($errors->all()) !!}
    {!! Form::model($book, ['route'=>['books.update',$book->id], 'method'=> 'PUT']) !!}
    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('author', 'Author') !!}
        {!! Form::text('author', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('year', 'Year') !!}
        {!! Form::text('year', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('genre', 'Genre') !!}
        {!! Form::text('genre', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
            {!! Form::label('user_id', 'ID User who will give this book') !!}
            {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
    </div>
    <div>
        {!! Form::hidden('_action', 'edit') !!}
        {!! Form::submit('Save',['class' =>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
    <br>
    <div class="form-group">
        @if($book->user_id)
            {!! Form::open(['url'=>'books/'. $book->id , 'class'=>'pull-left']) !!}
            {!! Form::hidden('_method', 'PATCH') !!}
            {!! Form::hidden('_action', 'remove') !!}
            {!! Form::hidden('_from', 'edit') !!}
            {!! Form::submit('Give back', ['class'=> 'btn btn-danger']) !!}
            {!! Form::close() !!}
        @endif
    </div>
@stop