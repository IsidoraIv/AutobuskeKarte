<?php
require('../baza/baza.php');
require('../klase/Linija.php');



$linija = new Linija($conn);
$linija->pocetna_destinacija = $_GET["pocetna_destinacija"];
$linija->krajnja_destinacija = $_GET["krajnja_destinacija"];
$linija->order_by = $_GET["order_by"];

echo json_encode($linija->loadLinijeZaDestinacije());




$conn->close();