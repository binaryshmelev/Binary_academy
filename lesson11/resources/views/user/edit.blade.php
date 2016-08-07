@extends('app')

@section('pagetitle')
    User edit
@stop

@section('content')
    {!! Html::ul($errors->all()) !!}
    {!! Form::model($user, ['route'=>['users.update', $user->id], 'method'=> 'PUT']) !!}
    <div class="form-group">
        {!! Form::label('firstname', 'FirstName') !!}
        {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('lastname', 'LastName') !!}
        {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'eMail') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('book', 'Enter ID of the free book to give her to user') !!}
        {!! Form::text('book', null, ['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Save',['class' =>'btn btn-primary']) !!}
    {!! Form::close() !!}

@stop