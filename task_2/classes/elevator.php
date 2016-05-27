<?php

namespace classes;

class Elevator {
    /**
     * Current floor of house
     * @param int
     */
    private $floor;

    /**
     * Current count humans in the elevator
     * @param int
     */
    private $humans;

    /**
     * Total count of floors in the house
     * @param int
     */
    private $total_floors;

    /**
     * Total limit of humans in the elevator
     * @param int
     */
    private $total_humans;

    /**
     * Constructor of class
     * @param int $total_floors
     * @param int $total_humans
     * @throws \exception
     */
    public function __construct($total_floors = 9, $total_humans = 4) {
        if (!is_int($total_floors)) {
            throw new \exception('Total floors must be an integer type.' . PHP_EOL);
        }

        if (!is_int($total_humans)) {
            throw new \exception('Total humans must be an integer type.' . PHP_EOL);
        }

        $this->floor = 1;
        $this->humans = new \SplStack();
        $this->total_floors = $total_floors;
        $this->total_humans = $total_humans;
    }

    /**
     * Display current status of the elevator
     */
    public function get_condition() {
        echo 'Elevator status: Floor: ' . $this->floor . ' People: ' . $this->humans->count() . PHP_EOL . PHP_EOL;
    }


    /**
     * Launch elevator to specified floor
     * @var integer $floor
     * @throws \exception
     */
    public function elevator_launch($floor) {
        if (!is_int($floor)) {
            throw new \exception('Floor must be integer type.' . PHP_EOL);
        }

        if ($floor < 1) {
            throw new \exception('Floor can not be less than one.' . PHP_EOL );
        }

        if ($floor > $this->total_floors) {
            throw new \exception('Floor can not be more than ' . $this->total_floors . PHP_EOL);
        }

        if ($this->humans->count() > $this->total_humans) {
            throw new \exception('Exceeded the capacity people limit of the elevator. Maximum capacity of people ' . $this->total_humans . PHP_EOL);
        }

        $this->floor = $floor;
        echo 'Done' . PHP_EOL . PHP_EOL;
    }

    /**
     * Add human in the elevator
     * @param int $human
     * @throws \exception
     */
    public function add_humans($human) {
        if (!is_int($human)) {
            throw new \exception('Human must be integer type.' . PHP_EOL);
        }

        if ($human < 0) {
            throw new \exception('Count of humans cannot be negative.' . PHP_EOL);
        }

        for ($i = 0; $i < $human; $i++ ) {
            $this->humans->push(1);
        }

        echo 'Done' . PHP_EOL . PHP_EOL;
    }

    /**
     * Remove human grom the elevator
     * @param int $human
     * @throws \exception
     */
    public function remove_humans($human) {
        if (!is_int($human)) {
            throw new \exception('Human must be integer type.' . PHP_EOL);
        }

        if ($human < 0) {
            throw new \exception('Count of humans cannot be negative.' . PHP_EOL);
        }

        if ($human > $this->humans->count()) {
            throw new \exception('In elevator ' . $this->humans->count() . ' humans now. You try remove ' . $human . PHP_EOL);
        }

        for ($i = 0; $i < $human; $i++ ) {
            $this->humans->pop();
        }

        echo 'Done' . PHP_EOL . PHP_EOL;
    }
}