<?php
namespace App\Lib\Smartphone;

class Camera {
    public $mpixels;

    /**
     * Constructor of class
     * @param int $mpixels
     */
    public function __construct(int $mpixels) {
        $this->mpixels = $mpixels;
    }
}