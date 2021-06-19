<?php
require('../baza/baza.php');
require('../klase/Linija.php');

$linija = new Linija($conn);
$linija->id = $_POST['id'];

echo json_encode($linija->izbrisiLinijuID());




$conn->close();