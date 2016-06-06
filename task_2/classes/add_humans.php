<?php
namespace classes;

class add implements ElevatorCommand {
    private $elevator;

    public function __construct(\classes\Elevator $elevator) {
        $this->elevator = $elevator;
    }

    public function execute($parametr) {
        $this->elevator->add_humans($parametr);
    }
}
