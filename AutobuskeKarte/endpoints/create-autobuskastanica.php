<?php
require('../baza/baza.php');
require('../klase/Autobuskastanica.php');

$stanica = new Autobuskastanica($conn);


$stanica->naziv = $_POST["naziv"];
$stanica->grad = $_POST["grad"];
$stanica->drzava = $_POST["drzava"];

if ($stanica->dodajStanicu()) {
    echo "Uspesno dodata STANICA!";
} else {
    echo "Nije uspesno dodata STANICA (mozda vec postoji u bazi)";
}


$conn->close();