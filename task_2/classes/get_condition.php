<?php
namespace classes;

class status implements ElevatorCommand {
    private $elevator;

    public function __construct(\classes\Elevator $elevator) {
        $this->elevator = $elevator;
    }

    public function execute($parametr) {
        $this->elevator->get_condition();
    }
}
