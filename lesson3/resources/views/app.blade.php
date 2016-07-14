<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse" style="">
        <ul class="nav navbar-nav">
            <li><a href="{{URL::to('books')}}">View All Books</a></li>
            <li><a href="{{URL::to('books/create')}}">Create a New Book</a></li>
            <li><a href="{{URL::to('users')}}">View All Users</a></li>
            <li><a href="{{URL::to('users/create')}}">Create a New User</a></li>
        </ul>
    </nav>
    <h1>@yield('pagetitle')</h1>

    @if(Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>