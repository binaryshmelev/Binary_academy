<?php
namespace classes;

class demo implements CalculatorCommand {
    private $calculator;

    public function __construct(\classes\Calculator $calculator) {
        $this->calculator = $calculator;
    }

    public function execute($number1, $number2) {
        $result = $this->calculator->addition(3, 5);
        echo '3 + 5 = ' . $result . PHP_EOL . PHP_EOL;

        $result = $this->calculator->subtract(10, 5);
        echo '10 - 5 = ' . $result . PHP_EOL . PHP_EOL;

        $result = $this->calculator->multiplication(4, 4);
        echo '4 * 4 = ' . $result . PHP_EOL . PHP_EOL;

        $result = $this->calculator->division(100, 10);
        echo '100 / 10 = ' . $result . PHP_EOL . PHP_EOL;

        try {
            echo '6 / 0 = ' . PHP_EOL;
            $this->calculator->division(6, 0);
        } catch (\DivisionByZeroError $e) {
            echo 'Second number is zero!' . PHP_EOL . PHP_EOL;
        }

        $result = $this->calculator->involution(2);
        echo '2 ^ 2 = ' . $result . PHP_EOL . PHP_EOL;

        try {
            echo '2 ^ Test = ' . PHP_EOL;
            $this->calculator->involution('Test');
        } catch (\Throwable $e) {
            echo 'Wrong arguments' . PHP_EOL . PHP_EOL;
        }
    }
}
