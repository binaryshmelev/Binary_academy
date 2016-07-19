@extends('layouts.app')

@section('pagetitle')
    Create User
@stop

@section('content')
    {!! Html::ul($errors->all()) !!}
    {!! Form::open(['url'=>'users']) !!}
    <div class="form-group">
        {!! Form::label('firstname', 'FirstName') !!}
        {!! Form::text('firstname', Input::old('firstname'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('lastname', 'LastName') !!}
        {!! Form::text('lastname', Input::old('lastname'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'eMail') !!}
        {!! Form::text('email', Input::old('email'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password') !!}
        {!! Form::text('password', Input::old('password'), ['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Save',['class' =>'btn btn-primary']) !!}
    {!! Form::close() !!}

@stop