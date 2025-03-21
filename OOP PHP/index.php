<?php

require_once("Animal.php");
require_once("Frog.php");
require_once("Ape.php");

$sheep = new Animal("Shaun");

echo "Name : " . $sheep->name . "<br>";
echo "Legs : " . $sheep->legs . "<br>";
echo "Cold Blooded : " . $sheep->cold_blooded . "<br><br>";

$katak = new Frog("Buduk");
$katak->makan();

$sungokong = new Ape("Kera Sakti");
$sungokong->kera();

?>