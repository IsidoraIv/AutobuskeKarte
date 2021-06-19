<?php

class Linija{

    private $konekcija;
    private $imeTabele = "linija";
    public $id; 
    public $autoprevoznik;

    public $polazak_at; 
    public $dolazak_at;

    public $pocetna_destinacija;
    public $krajnja_destinacija;

    public $order_by = "id";

    public function __construct($konekcija)
    {
        $this->konekcija = $konekcija;
    }

    public function loadLinije()
    {

        $sql = "SELECT * FROM " . $this->imeTabele . " ORDER BY " . $this->order_by;

        $res = $this->konekcija->query($sql);
        $nizLinija = [];
        if ($res->num_rows > 0) {
            while ($red = $res->fetch_assoc()) {
                $red['pocetna_destinacija'] =  $this->getStanicaByID($red['pocetna_destinacija']);
                $red['krajnja_destinacija'] =  $this->getStanicaByID($red['krajnja_destinacija']);
                array_push($nizLinija, $red);
            }
            return $nizLinija;
        }
    }

    private function getStanicaByID($id)
    {
        $sql = "SELECT * FROM autobuskastanica WHERE  id = " . $id;
        $res = $this->konekcija->query($sql);

        if ($res->num_rows > 0) {
            return $res->fetch_assoc()['grad'];
        }
    }

    public function loadLinijeZaDestinacije()
    {

        $sql = "SELECT * FROM " . $this->imeTabele . " WHERE  pocetna_destinacija = " . $this->pocetna_destinacija . " AND krajnja_destinacija = " . $this->krajnja_destinacija . " ORDER BY " . $this->order_by;

        $res = $this->konekcija->query($sql);
        $nizLinija = [];
        if ($res->num_rows > 0) {
            while ($red = $res->fetch_assoc()) {
                $red['pocetna_destinacija'] =  $this->getStanicaByID($this->pocetna_destinacija);
                $red['krajnja_destinacija'] =  $this->getStanicaByID($this->krajnja_destinacija);
                array_push($nizLinija, $red);
            }
            return $nizLinija;
        }
    }

    public function loadPristigleLinije()
    {
        $sql = "SELECT * FROM " . $this->imeTabele . " WHERE dolazak_at is not null ORDER BY " . $this->order_by;

        $res = $this->konekcija->query($sql);
        $nizLinija = [];

        if ($res->num_rows) {
            while ($red = $res->fetch_assoc()) {
                $red['pocetna_destinacija'] =  $this->getStanicaByID($red['pocetna_destinacija']);
                $red['krajnja_destinacija'] =  $this->getStanicaByID($red['krajnja_destinacija']);
                array_push($nizLinija, $red);
            }
            return $nizLinija;
        }
    }

    public function dodajLiniju()
    {

        $sql = "INSERT INTO " . $this->imeTabele . "(autoprevoznik, polazak_at, pocetna_destinacija, krajnja_destinacija) VALUES ('" . $this->autoprevoznik . "'," . $this->polazak_at . ", " . $this->pocetna_destinacija . ", " . $this->krajnja_destinacija . ")";


        if ($this->konekcija->query($sql))
            return true;

        return false;
    }

    public function dolazak()
    {
        $sql = "UPDATE " . $this->imeTabele . " SET dolazak_at = " . (time()) . " WHERE id= " . $this->id;
        if ($this->konekcija->query($sql))
            return true;

        return false;
    }

    public function izbrisiLinijuID()
    {

        $sql = "DELETE FROM " . $this->imeTabele . " WHERE id=" . $this->id;

        if ($this->konekcija->query($sql))
            return true;
        return false;
    }


}



?>