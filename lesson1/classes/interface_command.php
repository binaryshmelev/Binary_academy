<?php
namespace classes;

interface CalculatorCommand {
    public function execute($numbers1, $numbers2);
}
