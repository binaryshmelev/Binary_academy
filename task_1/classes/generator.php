<?php
namespace classes;

class Generator {
    private static function triangularsNumbers($limit = 15) {
        for ($i = 0; $i <= $limit; $i++) {
            yield 1/2*$i*($i+1);
        }
    }

    public static function print_result() {
        foreach(self::triangularsNumbers() as $number) {
            echo $number . ' ';
        }
    }
}