<?php
namespace App\Lib\Smartphone;

class Processor {
    public $vendor;
    public $cores;

    /**
     * Constructor of class
     * @param string $vendor
     * @param int $cores
     */
    public function __construct(string $vendor, int $cores) {
        $this->vendor = $vendor;
        $this->cores = $cores;
    }
}