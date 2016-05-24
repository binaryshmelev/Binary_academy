<?php

class Application {
    use RandomQuote;

    public function start() {
        echo $this->getRandomQuote();
    }
}