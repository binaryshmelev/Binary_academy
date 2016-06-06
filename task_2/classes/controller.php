<?php

namespace classes;

class Controller
{
    /**
     * @param \classes\Elevator
     */
    private $elevator;

    /**
     * Mark of the end script
     * @param bool
     */
    private $end_script = false;

    /**
     * Error message
     * @param string
     */
    private $error = 'Oops! Something went wrong, try again.';

    /**
     * Constructor of class
     * @param int $total_floors
     * @param int $total_humans
     * @throws \exception
     */
    public function __construct($total_floors = 9, $total_humans = 4) {
        $this->elevator = new \classes\Elevator($total_floors, $total_humans);
    }

    /**
     * Start script
     */
    public function start()
    {
        $this->clear_console();
        $this->help();

        while (!$this->end_script) {
            $this->action();
        }

        echo PHP_EOL . 'The END :)' . PHP_EOL;
    }

    /**
     * Display help section
     */
    private function help() {
         echo PHP_EOL . 'Help section:' . PHP_EOL . PHP_EOL;
         echo 'To get the current status of the elevator enter "status".' . PHP_EOL;
         echo 'To launch the elevator to specified floor (1-9) enter "launch {floor}".' . PHP_EOL;
         echo 'To add humans into the elevator (max 4 person) enter "add {human}".' . PHP_EOL;
         echo 'To remove humans from the elevator enter "remove {human}".' . PHP_EOL;
         echo 'To show help enter "?".' . PHP_EOL;
         echo 'To clear console enter "clear".' . PHP_EOL;
         echo 'To the end enter "end"' . PHP_EOL;
         echo PHP_EOL;
    }

    /**
     * Clear console
     */
    private function clear_console() {
        popen('cls', 'w');
    }

    /**
     * Actions from console
     */
    private function action() {
        do {
            echo 'Please enter action: ';
            $action = trim(fgets(STDIN));
        } while (empty($action));

        $action = explode(' ', $action);
        $class = '\classes\\' . $action[0];

        try {
            if ((in_array($action[0], array('launch', 'add', 'remove'))) &&
                (intval($action[1]) == 0)) {
                throw new \Exception( $this->error . PHP_EOL . PHP_EOL );
            }

            switch ($action[0]) {
                case '?' : $this->help();
                    break;

                case 'clear' : $this->clear_console();
                    break;

                case 'end' : $this->end_script = true;
                    break;

                default : if (class_exists($class)) {
                    $command = new $class($this->elevator);
                    $command->execute(intval($action[1]));
                } else {
                    echo $this->error . PHP_EOL . PHP_EOL;
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }
}