<?php
require('../baza/baza.php');
require('../klase/Autobuskastanica.php');

$stanica = new Autobuskastanica($conn);

echo json_encode($stanica->loadStanicu());




$conn->close();