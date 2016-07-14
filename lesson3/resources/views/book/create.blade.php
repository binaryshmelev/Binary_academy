@extends('app')

@section('pagetitle')
    Create Book
@stop

@section('content')

    {!! Html::ul($errors->all()) !!}
    {!! Form::open(['url'=>'books']) !!}
    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', Input::old('title'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('author', 'Author') !!}
        {!! Form::text('author', Input::old('author'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('year', 'Year') !!}
        {!! Form::text('year', Input::old('year'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('genre', 'Genre') !!}
        {!! Form::text('genre', Input::old('genre'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('user_id', 'ID User for give this book') !!}
        {!! Form::text('user_id', Input::old('user_id'), ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Save',['class' =>'btn btn-primary']) !!}

    {!! Form::close() !!}


@stop