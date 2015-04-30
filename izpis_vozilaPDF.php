<?php
	session_start();
	if($_POST['ID_taksimetra']==""){
		$_SESSION['napaka']="VNOS NI BIL USPESEN: Neko polje je prazno.";
		header("location: poizvedba_vozila.php");
	}



?>
<!DOCTYPE html>
<html>
<head>
	<title>POIZVEDBA ZA VOZILA</title>

	<link rel="stylesheet" type="text/css" href="stil_izpis.css">
</head>
<body>
<div id="centriranaForma">
	<?php

    require('phpToPDF.php');



	$povezava = new mysqli("localhost", "root", "", "taksi_sluzba");//link na bazo
		if ($povezava->connect_errno) {
    		echo "Napaka: " . $mysqli->connect_error; // napise do kaksne napake je prislo
		}
		/*
	$poizvedba="SELECT Registrska_stevilka, Tip_vozila FROM vozilo WHERE ID_vozila=".$_POST['ID_vozila'];
	$rezultat=$povezava->query($poizvedba);
	$vrstica = $rezultat->fetch_assoc(); // potegnes ven vrstico iz rezultata
	*/
	$poizvedba="SELECT Proizvajalec, Tip_taksimetra, Serijska_st, Programska_verzija, Preskok, Uradna_oznaka  FROM taksimeter WHERE ID_taksimeter=".$_POST['ID_taksimetra'];
	$rezultat=$povezava->query($poizvedba);
	$taksimeter = $rezultat->fetch_assoc(); // potegnes ven vrstico iz rezultata


	$poizvedba="SELECT Registrska_stevilka, Tip_vozila, Dimenzije_pnevmatik, st_sasije, Konstanta_vozila FROM vozilo WHERE ID_taksimeter=".$_POST['ID_taksimetra'];
	$rezultat=$povezava->query($poizvedba);
	$vozilo = $rezultat->fetch_assoc(); //vemo da je samo 1 vrstica

	$poizvedba="SELECT Vrsta, Startnina, Voznja_km, Cakalna_ura, Startnina_nocna, Cakalna_ura_nocna, Voznja_km_nocna FROM Vrsta_tarife";
	$tarife=$povezava->query($poizvedba); //dobimo več tarif ven, z while bomo pobirali ven vrstice(vrednosti)
		$mydate=getdate(date("U"));

//$html = "";
	$html= "<table>";
		$html.= "<tr>";
			$html.= "<td colspan=4><h1>Zapisnik o vgradnji in nastavitvi  taksimetra s serijsko st: serijska st</h1></td>";
		$html.= "</tr>";
		//VOZILO
		$html.= "<tr>";
			$html.= "<td><b> Vozilo</b></td>";
		$html.= "</tr>";

		$html.= "<tr>";
			$html.= "<td width='15%'> Tip vozila:</td>";
			$html.= "<td width='35%'> ".$vozilo['Tip_vozila']."</td>";
			$html.= "<td width='15%'>Registrska stevilka: </td>";
			$html.= "<td width='35%'> ".$vozilo['Registrska_stevilka']."</td>";
		$html.= "</tr>";
		$html.= "<tr>";
			$html.= "<td> Stevilka sasije: </td>";
			$html.= "<td> ".$vozilo['st_sasije']."</td>";
			$html.= "<td> Konstanta vozila W: </td>";
			$html.= "<td> ".$vozilo['Konstanta_vozila']."</td>";
		$html.= "</tr>";
		$html.= "<tr>";
			$html.= "<td> Dimenzije pnevmatik: </td>";
			$html.= "<td colspan=3> ".$vozilo['Dimenzije_pnevmatik']."</td>";
		$html.= "</tr>";



//TAKSIMETER
$html.= "<tr>";
			$html.= "<td><b> Taksimeter</b></td>";
		$html.= "</tr>";

		$html.= "<tr>";
			$html.= "<td> Proizvajalec:</td>";
			$html.= "<td> ".$taksimeter['Proizvajalec']."</td>";
			$html.= "<td>Serijska stevilka: </td>";
			$html.= "<td> ".$taksimeter['Serijska_st']."</</td>";
		$html.= "</tr>";
		
		$html.= "<tr>";
			$html.= "<td> Tip taksimetra: </td>";
			$html.= "<td colspan=3> ".$taksimeter['Tip_taksimetra']."</</td>";
		$html.= "</tr>";
		$html.= "<tr>";
			$html.= "<td> Uradna oznaka: </td>";
			$html.= "<td colspan=3> ".$taksimeter['Uradna_oznaka']."</</td>";
		$html.= "</tr>";
		$html.= "<tr>";
			$html.= "<td> Programska verzija:</td>";
			$html.= "<td> ".$taksimeter['Programska_verzija']."</</td>";
		$html.= "</tr>";

		//TABELA TARIF
		$html.= "<tr>";
			$html.= "<td colspan=4>";
				$html.= "<table border=1 width='100%'>";
					$html.= "<tr>";
					$html.= "<td>Preskok: </td>";
					$html.= "<td>".$taksimeter['Preskok']."</td>";
					$html.= "<td>EUR</td>";
					$html.= "<td></td>";
					$html.= "<td></td>";
					$html.= "<td></td>";
					$html.= "<td></td>";
					$html.= "<td></td>";
					$html.= "</tr>";
 	
					$html.= "<tr>";
					$html.= "<td>Tarifa: </td>";
					$html.= "<td>Vrsta: </td>";
					$html.= "<td>Startnina: </td>";
					$html.= "<td>KM/EUR</td>";
					$html.= "<td>Cakalna ura</td>";
					$html.= "<td>Startnina nocna</td>";
					$html.= "<td>KM/EUR nocni</td>";
					$html.= "<td>Cakalna ura nocna</td>";
					$html.= "</tr>";
					for($i=0; $i<$tarife->num_rows; $i++){ //gre do konca stevila vrstic oz. kolikor je tarif v bazi
						$tarifa=$tarife->fetch_assoc();
						echo "<tr>";
						echo "<td>Tarifa ". ($i+1)."</td>";
						echo "<td>".$tarifa['Vrsta']."</td>";
						echo "<td>".$tarifa['Startnina']."</td>";
						echo "<td>".$tarifa['Voznja_km']."</td>";
						echo "<td>".$tarifa['Cakalna_ura']."</td>";
						echo "<td>".$tarifa['Startnina_nocna']."</td>";
						echo "<td>".$tarifa['Voznja_km_nocna']."</td>";
						echo "<td>".$tarifa['Cakalna_ura_nocna']."</td>";
						echo "</tr>";
					}
				$html.= "</table>";
			$html.= "</td>";
		$html.= "</tr>";
		$html.= "<tr>";
		//echo "$mydate[month] $mydate[mday], $mydate[year]
			$html.= "<td> Datum posega:</td>";
			$html.= "<td> ".$mydate['mday']." ".$mydate['month']." ".$mydate['year']."</td>";
			$html.= "<td>Datum izdaje zapisnika: </td>";
			$html.= "<td> ".$mydate['mday']." ".$mydate['month']." ".$mydate['year']."</td>";
		$html.= "</tr>";
		
	$html.= "</table>";



$pdf_options = array(
      "source_type" => 'html',
      "source" => $html,
      "action" => 'save',
      "save_directory" => 'my_pdfs',
      "file_name" => 'my_filename.pdf');

    //Code to generate PDF file from options above
    phptopdf($pdf_options);




	?>
</div>

	<!--<input type="button" value="kreiraj PDF"/>-->

</body>
</html>

