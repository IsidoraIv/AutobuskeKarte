<!DOCTYPE html>
<html lang="en">

<?php include('./head.php') ?>

<body>

    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table" id="tabelaLinija">

                </table>
            </div>
            <div class="col-3">
                <button class="btn btn-block btn-danger" id="toggleFormaLinija">Dodaj novu liniju</button>
                <form id="formaLinija">
                    <input placeholder="Autoprevoznik" type="text" id="autoprevoznik">
                    Iz:
                    <select class="autobuskastanica" id="pocetna_destinacija">
                        <option value="0">Izaberite neku autobusku stanicu</option>
                    </select>
                    <br>
                    U:
                    <select class="autobuskastanica" id="krajnja_destinacija">
                        <option value="0">Izaberite neku autobusku stanicu</option>
                    </select>

                    <input type="datetime-local" id="polazak_at">
                    <input type="submit" value="Submit">
                </form>

                <button class="btn btn-block btn-danger" id="toggleFormaStanica">Dodaj novu stanicu</button>
                <form id="formaStanica">
                    <input placeholder="Naziv" type="text" id="naziv">
                    <input placeholder="Grad" type="text" id="grad">
                    <input placeholder="Drzava" type="text" id="drzava">
                    <input type="submit" value="Submit">
                </form>
                <button class="btn btn-block btn-danger" id="toggleFormaLinijeDestinacija">Nadji specificnu liniju</button>
                <form id="formaLinijeDestinacija">
                    Iz:
                    <select class="autobuskastanica" id="pocetna_destinacija_select">
                        <option value="0">Izaberite neku stanicu</option>
                    </select>
                    <br>
                    U:
                    <select class="autobuskastanica" id="krajnja_destinacija_select">
                        <option value="0">Izaberite neku stanicu</option>
                    </select>
                    <select id="order_by_destinacija">
                        <option value="0">Izaberite sortiranje</option>
                        <option value="polazak_at">Po polasku</option>
                        <option value="autoprevoznik">Po autoprevozniku</option>
                        <option value="pocetna_destinacija">Po pocetnoj destinaciji</option>
                    </select>
                    <input type="submit" value="Submit">
                </form>
                <button class="btn btn-block btn-danger" id="stigleLinije">Prikazi pristigle linije</button>
                <form id="stigleLinijeForm">
                    <select id="order_by_stigli">
                        <option value="0">Izaberite sortiranje</option>
                        <option value="polazak_at">Po polasku</option>
                        <option value="autoprevoznik">Po autoprevozniku</option>
                        <option value="pocetna_destinacija">Po pocetnoj destinaciji</option>
                    </select>
                    <input type="submit" value="Submit">
                </form>
                <button class="btn btn-block btn-danger" id="prikaziLinije">Prikazi sve linije</button>
                <form id="prikaziLinijeForm">
                    <select id="order_by_svi">
                        <option value="0">Izaberite sortiranje</option>
                        <option value="polazak_at">Po polasku</option>
                        <option value="autoprevoznik">Po autoprevozniku</option>
                        <option value="pocetna_destinacija">Po pocetnoj destinaciji</option>
                    </select>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>


    <?php include('./scripts.php') ?>
</body>

</html>