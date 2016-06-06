<?php
namespace classes;

class launch implements ElevatorCommand {
    private $elevator;

    public function __construct(\classes\Elevator $elevator) {
        $this->elevator = $elevator;
    }

    public function execute($parametr) {
        $this->elevator->elevator_launch($parametr);
    }
}
