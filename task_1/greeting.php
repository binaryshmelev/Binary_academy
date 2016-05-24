<?php
require __DIR__ . '\vendor\autoload.php';

class Greeting {
    use RandomQuote;

    public function say($name) {
        echo "Hi, {$name}! There is a new quote for you: {$this->getRandomQuote()}";
    }
}

$test_greeting = (new Greeting)->say('Student');