<?php
require('../baza/baza.php');
require('../klase/Linija.php');



$linija = new Linija($conn);

$linija->autoprevoznik = $_POST["autoprevoznik"];
$linija->polazak_at = $_POST["polazak_at"];
$linija->pocetna_destinacija = $_POST["pocetna_destinacija"];
$linija->krajnja_destinacija = $_POST["krajnja_destinacija"];

if ($linija->dodajLiniju())
    echo "Dodata linija!";
else
    echo "Linija nije uspesno kreirana (doslo je do greske prilikom kreiranja).";

$conn->close();