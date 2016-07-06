<?php
namespace App\Lib\Smartphone;

class Battery {
    public $capacity;

    /**
     * Constructor of class
     * @param int $capacity
     */
    public function __construct(int $capacity) {
        $this->capacity = $capacity;
    }
}