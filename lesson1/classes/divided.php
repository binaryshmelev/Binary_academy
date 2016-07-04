<?php
namespace classes;

class divided implements CalculatorCommand {
    private $calculator;

    public function __construct(\classes\Calculator $calculator) {
        $this->calculator = $calculator;
    }

    public function execute($number1, $number2) {
        $result = $this->calculator->division($number1, $number2);
        echo $number1 . ' / ' . $number2 . ' = ' . $result . PHP_EOL . PHP_EOL;
    }
}
