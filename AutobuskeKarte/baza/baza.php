<?php

$imeservera = "localhost:3306";
$ime = "root";
$pass = "";
$imebaze = "buskarte";


$conn = new mysqli($imeservera, $ime, $pass, $imebaze);

if ($conn->connect_error) {
    die($conn->connect_error);
}