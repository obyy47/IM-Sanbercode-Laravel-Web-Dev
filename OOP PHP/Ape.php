<?php

require_once("animal.php");

class Ape extends Animal{
    public $legs = 2;
    public $yell = "Auooo";

    public function kera()
    {
        echo "Name : " . $this->name . "<br>";
        echo "Legs : " . $this->legs . "<br>";
        echo "Cold Blooded : " . $this->cold_blooded . "<br>";
        echo "Jump : " . $this->yell . "<br>";
        echo "Kera adalah mamalia yang merupakan bagian dari ordo Primata bersama dengan monyet. <br><br>";
    }
}


?>