<?php

class Greeting
{
    private $word = "Hello";
}

$closure = function ($whom) {
    echo "$this->word $whom";
};
$objj = new Greeting();
$closure->call($objj, 'John');
echo '<br>';
$closure->call($objj, 'Kevin');
?>
