<?php
namespace App\Lib\Smartphone;

class Smartphone {
    protected $name;
    protected $processor;
    protected $display;
    protected $camera;
    protected $battery;

    /**
     * Constructor of class
     * @param string $name
     * @param Processor $processor
     * @param Display $display
     * @param Camera $camera
     * @param Battery $battery
     */
    public function __construct(string $name, Processor $processor, Display $display, Camera $camera, Battery $battery) {
        $this->name = $name;
        $this->processor = $processor;
        $this->display = $display;
        $this->camera = $camera;
        $this->battery = $battery;
    }

    public function get_info() : string {
        $info = $this->name . ', ';
        $info .= $this->processor->vendor . ' ' . $this->processor->cores . ' cores, ';
        $info .= $this->display->resolution . ' display, ';
        $info .= $this->camera->mpixels . ' megapixels camera, ';
        $info .= 'battery capacity ' . $this->battery->capacity . ' mAh.';

        return $info;
    }
}