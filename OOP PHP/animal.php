<?php

class Animal{
    public $legs = 4;
    public $name;
    public $cold_blooded = "No";

    public function __construct($hewan){
        $this->name = $hewan;
    }
}


?>