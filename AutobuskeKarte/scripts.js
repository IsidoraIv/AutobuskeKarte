$(document).ready(function () {
    getStanice();
  
    $("#toggleFormaLinija").click(function (e) {
      e.preventDefault();
      $("form:not(#formaLinija)").hide("slower");
      $("#formaLinija").toggle("slower");
    });
    $("#toggleFormaStanica").click(function (e) {
      e.preventDefault();
      $("form:not(#formaStanica)").hide("slower");
      $("#formaStanica").toggle("slower");
    });
    $("#toggleFormaLinijeDestinacija").click(function (e) {
      e.preventDefault();
      $("form:not(#formaLinijeDestinacija)").hide("slower");
      $("#formaLinijeDestinacija").toggle("slower");
    });
    $("#stigleLinije").click(function (e) {
      e.preventDefault();
      $("form:not(#stigleLinijeForm)").hide("slower");
      $("#stigleLinijeForm").toggle("slower");
    });
    $("#prikaziLinije").click(function (e) {
      e.preventDefault();
      $("form:not(#prikaziLinijeForm)").hide("slower");
      $("#prikaziLinijeForm").toggle("slower");
    });
  
    $("body").on("click", ".dolazak", function (e) {
     updateLinija(e.target.id);
    });
    $("body").on("click", ".brisanje", function (e) {
      deleteLinija(e.target.id);
    });
  
    $("#formaLinija").submit(function (e) {
      e.preventDefault();
      let autoprevoznik = $("#autoprevoznik").val();
      let polazak_at = parseInt(Date.parse($("#polazak_at").val())) / 1000;
      let pocetna_destinacija = $("#pocetna_destinacija").val();
      let krajnja_destinacija = $("#krajnja_destinacija").val();
      dodajLiniju(autoprevoznik, polazak_at, pocetna_destinacija, krajnja_destinacija);
    });
    $("#formaStanica").submit(function (e) {
      e.preventDefault();
      let naziv = $("#naziv").val();
      let grad = $("#grad").val();
      let drzava = $("#drzava").val();
  
      dodajStanicu(naziv, grad, drzava);
    });
    $("#formaLinijeDestinacija").submit(function (e) {
      e.preventDefault();
      let pocetna_destinacija = $("#pocetna_destinacija_select").val();
      let krajnja_destinacija = $("#krajnja_destinacija_select").val();
      let order_by = $("#order_by_destinacija").val();
      getLinijeDestinacija(pocetna_destinacija, krajnja_destinacija, order_by);
    });
    $("#stigleLinijeForm").submit(function (e) {
      e.preventDefault();
      let order_by = $("#order_by_stigli").val();
      getLinijeStigle(order_by);
    });
    $("#prikaziLinijeForm").submit(function (e) {
      e.preventDefault();
      let order_by = $("#order_by_svi").val();
      getLinijeSve(order_by);
    });
  
    function dodajLiniju(
      autoprevoznik,
      polazak_at,
      pocetna_destinacija,
      krajnja_destinacija
    ) {
      $.ajax({
        type: "POST",
        url: "http://localhost:80/domaci/endpoints/create-linija.php",
        data: {
          autoprevoznik: autoprevoznik,
          polazak_at: polazak_at,
          pocetna_destinacija: pocetna_destinacija,
          krajnja_destinacija: krajnja_destinacija,
        },
        dataType: "json",
        success: function (response) {},
      });
    }
    function dodajStanicu(naziv, grad, drzava) {
      $.ajax({
        type: "POST",
        url: "http://localhost:80/domaci/endpoints/create-autobuskastanica.php",
        data: {
          naziv: naziv,
          grad: grad,
          drzava: drzava,
        },
        dataType: "json",
        success: function (response) {
          ispisi(response);
        },
      });
    }
    function getLinijeSve(order_by) {
      $.ajax({
        type: "GET",
        url: "http://localhost/domaci/endpoints/get-linije.php",
        data: {
          order_by: order_by,
        },
        dataType: "json",
        success: function (linije) {
          linije = JSON.parse(JSON.stringify(linije));
          ispisi(linije);
        },
      });
    }
    function getLinijeStigle(order_by) {
      $.ajax({
        type: "GET",
        url:
          "http://localhost:80/domaci/endpoints/get-linije-stigao.php",
        data: {
          order_by: order_by,
        },
        dataType: "json",
        success: function (linije) {
          linije = JSON.parse(JSON.stringify(linije));
          ispisi(linije);
        },
      });
    }
    function getLinijeDestinacija(
      pocetna_destinacija,
      krajnja_destinacija,
      order_by
    ) {
      $.ajax({
        type: "GET",
        url:
          "http://localhost:80/domaci/endpoints/get-linije-destinacije.php",
        data: {
          pocetna_destinacija: pocetna_destinacija,
          krajnja_destinacija: krajnja_destinacija,
          order_by: order_by,
        },
        dataType: "json",
        success: function (linije) {
          linije = JSON.parse(JSON.stringify(linije));
  
          ispisi(linije);
        },
      });
    }
    function getStanice() {
      $.ajax({
        type: "GET",
        url: "http://localhost:80/domaci/endpoints/get-stanice.php",
        success: function (stanice) {
            stanice = JSON.parse(stanice);
          console.log(stanice);
          for (let index = 0; index < stanice.length; index++) {
            $(".autobuskastanica").append(
              new Option(stanice[index].grad, stanice[index].id)
            );
          }
        },
      });
    }
  
    function deleteLinija(id) {
      $.ajax({
        type: "POST",
        url: "http://localhost:80/domaci/endpoints/delete-linija.php",
        data: {
          id: id,
        },
        dataType: "json",
        success: function (response) {},
      });
    }
    function updateLinija(id) {
      $.ajax({
        type: "POST",
        url: "http://localhost80/domaci/endpoints/update-linija.php",
        data: {
          id: id,
        },
        dataType: "json",
        success: function (response) {
          alert(response);
        },
      });
    }
  
    function ispisi(linije) {
      $("#tabelaLinija").html("");
      $("#tabelaLinija").html(`
              <thead>
                  <tr>
                      <th scope="col">Autoprevoznik</th>
                      <th scope="col">Polazak</th>
                      <th scope="col">Iz</th>
                      <th scope="col">Dolazak</th>
                      <th scope="col">U</th>
                  </tr>
              </thead>
              
              `);
  
      for (const linija of linije) {
        let dolazak;
        if (linija.dolazak_at == null) {
          dolazak = "nije";
        } else {
          dolazak = formatiranjeVremena(parseInt(linija.dolazak_at));
        }
        $("#tabelaLinija").append(`
                 <tbody>
                  <tr>
                      <td>${
                        linija.autoprevoznik
                      } <button class ="btn btn-danger brisanje" id = ${linija.id}>X</button></td>
                      <td>${formatiranjeVremena(parseInt(linija.polazak_at))}</td>
                      <td>${linija.pocetna_destinacija}</td>
                      <td id = "${linija.id}" class = "dolazak">${dolazak}</td>
                      <td>${linija.krajnja_destinacija}</td>
                  </tr>
              </tbody>
                 `);
      }
  
      console.log(linije);
    }
  });
  

  function formatiranjeVremena(vremeUSek) {
    let formatiranDatum;
    vremeUSek = parseInt(vremeUSek * 1000);
    const datum = new Date(vremeUSek);
  
    const minuti = datum.getMinutes().toString();
    const sati = datum.getHours().toString();
    const danUMesecu = datum.getDate().toString();
    const godina = datum.getFullYear().toString();
    const mesec = (datum.getMonth()+1).toString();
    if (minuti < 10)
      formatiranDatum = `| ${danUMesecu}.${mesec}.${godina} | ${sati}:0${minuti} |`;
    else {
      formatiranDatum = `| ${danUMesecu}.${mesec}.${godina} | ${sati}:${minuti} |`;
    }
    return formatiranDatum;
  }