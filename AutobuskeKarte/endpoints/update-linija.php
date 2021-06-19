<?php
require('../baza/baza.php');
require('../klase/Linija.php');

$linija = new Linija($conn);
$linija->id = $_POST['id'];

if ($linija->dolazak()) {
    //echo "Evidentiran datum dolaska autobusa!";
}



$conn->close();