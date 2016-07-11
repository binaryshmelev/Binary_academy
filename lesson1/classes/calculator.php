<?php
declare (strict_types=1);

namespace classes;

class Calculator {
    /**
     * Logging
     */
    private $logging;

    public function __construct() {
        $this->logging = new class {
            public function save(array $data){
                $filename = "logs.txt";
                $line = date('d.m.Y H:i:s');

                foreach ($data as $value) {
                    $line .= ' ' . $value . ' ';
                }

                $line .= PHP_EOL;
                file_put_contents($filename, $line, FILE_APPEND | LOCK_EX);
            }
        };
    }

    /**
     * Addition numbers
     */
    public function addition(int $first_operand, int $second_operand) : int {
        $result = $first_operand + $second_operand;
        $this->logging->save(['Addition', $first_operand, $second_operand, $result]);
        return $result;
    }

    /**
     * Subtract numbers
     */
    public function subtract(int $first_operand, int $second_operand) : int {
        $result = $first_operand - $second_operand;
        $this->logging->save(['Subtract', $first_operand, $second_operand, $result]);
        return $result;
    }

    /**
     * Multiplication numbers
     */
    public function multiplication(int $first_operand, int $second_operand) : int {
        $result = $first_operand * $second_operand;
        $this->logging->save(['Multiplication', $first_operand, $second_operand, $result]);
        return $result;
    }

    /**
     * Division numbers
     */
    public function division(int $first_operand, int $second_operand) : int {
        $result = intdiv($first_operand, $second_operand);
        $this->logging->save(['Division', $first_operand, $second_operand, $result]);
        return $result;
    }

    /**
     * Involution numbers
     */
    public function involution(int $first_operand) : int {
        $result = 2 ** $first_operand;
        $this->logging->save(['Involution', $first_operand, $result]);
        return $result;
    }
}