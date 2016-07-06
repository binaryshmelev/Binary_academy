<?php
namespace App\Lib\Smartphone;

class Display {
    public $resolution;

    /**
     * Constructor of class
     * @param string $resolution
     */
    public function __construct(string $resolution) {
        $this->resolution = $resolution;
    }
}