<?php
namespace Marvel;

abstract class Marvel_heroes {
    public static function whoami() {
        $full_name = explode('\\', get_called_class());
        return "I`am {$full_name[2]} from {$full_name[1]} <br>";
    }
}