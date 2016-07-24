@extends('app')

@section('pagetitle')
    Create User
@stop

@section('content')
    {!! Html::ul($errors->all()) !!}
    {!! Form::open(['url'=>'users']) !!}
    <div class="form-group">
        {!! Form::label('firstName', 'FirstName') !!}
        {!! Form::text('firstName', Input::old('firstName'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('lastName', 'LastName') !!}
        {!! Form::text('lastName', Input::old('lastName'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'eMail') !!}
        {!! Form::text('email', Input::old('email'), ['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Save',['class' =>'btn btn-primary']) !!}
    {!! Form::close() !!}

@stop