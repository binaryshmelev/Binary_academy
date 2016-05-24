<?php

trait RandomQuote {
    private $quotes = array(
        "Failure does not mean I'm a failure; It does mean I have not yet succeeded",
        "An honest answer is the sign of true friendship.",
        "No act of kindness, no matter how small, is ever wasted",
        "Keep cool; anger is not an argument",
        "Formal education will make you a living. Self-education will make you a fortune",
        "It does not matter how slowly you go so long as you do not stop",
        "Experience is the name every one gives to their mistakes.",
        "Work saves us from three great evils: boredom, vice and need.",
    );

    public function getRandomQuote() {
        return $this->quotes[array_rand($this->quotes)];
    }
}