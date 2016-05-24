<?php
require __DIR__ . '\vendor\autoload.php';

$quote = (new Application())->start();

/* Result of start Development Server

    D:\SERVERS\domains\localhost\public_html>php -S localhost:8000 index.php
    PHP 5.6.21 Development Server started at Tue May 24 21:41:47 2016
    Listening on http://localhost:8000
    Document root is D:\SERVERS\domains\localhost\public_html
    Press Ctrl-C to quit.

*/