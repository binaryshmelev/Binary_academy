<?php
namespace classes;

class remove implements ElevatorCommand {
    private $elevator;

    public function __construct(\classes\Elevator $elevator) {
        $this->elevator = $elevator;
    }

    public function execute($parametr) {
        $this->elevator->remove_humans($parametr);
    }
}
