<?php

require_once("animal.php");

class Frog extends Animal{
    public $jump = "Hop Hop";

    public function makan()
    {
        echo "Name : " . $this->name . "<br>";
        echo "Legs : " . $this->legs . "<br>";
        echo "Cold Blooded : " . $this->cold_blooded . "<br>";
        echo "Jump : " . $this->jump . "<br>";
        echo "Katak merupakan hewan amfibi atau hewan yang hidup di dua alam yaitu air dan daratan. <br><br>";
    }
}

?>