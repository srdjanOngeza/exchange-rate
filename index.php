<!DOCTYPE html>

<html>
  <head>
 
    <meta http-equiv='Content-Type' content='Type=text/html; charset=utf-8'>
    <!--Ucitava se API biblioteka za Google Charts-->
	<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['annotationchart']}]}"></script>
	<link href="styl.css" rel="stylesheet" type="text/css" />
    <!--Ucitava se JQuery biblioteka-->
    <script type="text/javascript" src="jquery-1.11.1.js"></script>
    <script type="text/javascript"> 
	
    // Ucitava se API za vizuelizaciju
    google.load('visualization', '1.1', {'packages':['annotationchart']});  
    // Šalje povratni poziv kada se ucita API
    google.setOnLoadCallback(crtajGrafik);
    // Funkcija šalje asinhrono JSON podatke, koje PHP fajl podaci.php generiše iz baze
    function crtajGrafik() {
      var jsonData = $.ajax({
      url: "json.php",
      dataType:"json",
      async: false
    }).responseText;  
    // Kreira se tabela sa podacima na osnovu poslatih JSON podataka
    var data = new google.visualization.DataTable(jsonData);

    // Instancira se grafikon (Column Chart je grafikon sa vertikalnim linijama) i prosleduju mu se parametri, ukljucujuci i ID div-a gde ce
    // grafikon biti prikazan
    var chart = new google.visualization.AnnotationChart(document.getElementById('chart_div'));
    var options = {
          displayAnnotations: true
        };

        chart.draw(data,options);
      }
 
  </script>
  </head>
<body>
<h1>Ongeza</h1>
<h2>Exchange Rates for previous month(1USD/TZS)</h2>
<!--DIV u kome ce biti prikazan grafikon-->
<div id="chart_div"></div>

</body>
</html>
