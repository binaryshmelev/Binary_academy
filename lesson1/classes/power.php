<?php
namespace classes;

class power implements CalculatorCommand {
    private $calculator;

    public function __construct(\classes\Calculator $calculator) {
        $this->calculator = $calculator;
    }

    public function execute($number1, $number2) {
        $result = $this->calculator->involution($number1);
        echo '2 ^ ' . $number1 . ' = ' . $result . PHP_EOL . PHP_EOL;
    }
}
