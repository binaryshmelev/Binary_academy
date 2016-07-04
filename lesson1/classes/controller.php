<?php

namespace classes;

class Controller
{
    /**
     * @param \classes\Calculator
     */
    private $calculator;

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
     */
    public function __construct() {
        $this->calculator = new \classes\Calculator();
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
         echo 'To additional numbers enter "$a plus $b".' . PHP_EOL;
         echo 'To subtract numbers enter "$a deduct $b".' . PHP_EOL;
         echo 'To multiplication numbers enter "$a multiply $b".' . PHP_EOL;
         echo 'To division numbers enter "$a divided $b".' . PHP_EOL;
         echo 'To involution 2 in power of the number enter "$a power".' . PHP_EOL;
         echo 'To show demo datas enter "demo".' . PHP_EOL;
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

        $actions = explode(' ', $action);
        $action = (count($actions) > 1) ? $actions[1] : $actions[0];
        $numbers1 = $actions[0];
        $numbers2 = (isset($actions[2])) ? $actions[2] : 0;
        $class = '\classes\\' . $action;

        try {
            switch ($action) {
                case '?' : $this->help();
                    break;

                case 'clear' : $this->clear_console();
                    break;

                case 'end' : $this->end_script = true;
                    break;

                default : if (class_exists($class)) {
                    $command = new $class($this->calculator);
                    $command->execute($numbers1, $numbers2);
                } else {
                    echo $this->error . PHP_EOL . PHP_EOL;
                }
            }
        } catch (\DivisionByZeroError $e) {
            echo 'Your second number is zero!' . PHP_EOL . PHP_EOL;
        } catch (\Throwable $e) {
            echo 'Wrong arguments' . PHP_EOL . PHP_EOL;
        }
    }
}