<?php

class Autobuskastanica
{
    public $id;
    public $naziv;
    public $grad;
    public $drzava;
    private $konekcija;
    private $imeTabele = "autobuskastanica";

    public function __construct($konekcija)
    {
        $this->konekcija = $konekcija;
    }

    public function loadStanicu()
    {

        $sql = "SELECT * FROM " . $this->imeTabele;

        $res = $this->konekcija->query($sql);

        $nizStanica = [];
        if ($res->num_rows > 0) {
            while ($red = $res->fetch_assoc()) {
                array_push($nizStanica, $red);
            }
        }

        return $nizStanica;
    }

    public function dodajStanicu()
    {
        $sql = "INSERT INTO " . $this->imeTabele . " (naziv, grad, drzava) VALUES ('" . $this->naziv . "', '" . $this->grad . "','" . $this->drzava . "')";


        if ($this->konekcija->query($sql))
            return true;

        return false;
    }
}