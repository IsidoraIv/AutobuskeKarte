<?php
require('../baza/baza.php');
require('../klase/Linija.php');

$linija = new Linija($conn);

$linija->order_by = $_GET["order_by"];

echo json_encode($linija->loadLinije());




$conn->close();