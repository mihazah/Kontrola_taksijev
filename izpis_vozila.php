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
	echo "<table>";
		echo "<tr>";
			echo "<td colspan=4><h1>Zapisnik o vgradnji in nastavitvi  taksimetra s serijsko st: serijska st</h1></td>";
		echo "</tr>";
		//VOZILO
		echo "<tr>";
			echo "<td><b> Vozilo</b></td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td width='15%'> Tip vozila:</td>";
			echo "<td width='35%'> ".$vozilo['Tip_vozila']."</td>";
			echo "<td width='15%'>Registrska stevilka: </td>";
			echo "<td width='35%'> ".$vozilo['Registrska_stevilka']."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td> Stevilka sasije: </td>";
			echo "<td> ".$vozilo['st_sasije']."</td>";
			echo "<td> Konstanta vozila W: </td>";
			echo "<td> ".$vozilo['Konstanta_vozila']."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td> Dimenzije pnevmatik: </td>";
			echo "<td colspan=3> ".$vozilo['Dimenzije_pnevmatik']."</td>";
		echo "</tr>";



//TAKSIMETER
echo "<tr>";
			echo "<td><b> Taksimeter</b></td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td> Proizvajalec:</td>";
			echo "<td> ".$taksimeter['Proizvajalec']."</td>";
			echo "<td>Serijska stevilka: </td>";
			echo "<td> ".$taksimeter['Serijska_st']."</</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td> Tip taksimetra: </td>";
			echo "<td colspan=3> ".$taksimeter['Tip_taksimetra']."</</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td> Uradna oznaka: </td>";
			echo "<td colspan=3> ".$taksimeter['Uradna_oznaka']."</</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td> Programska verzija:</td>";
			echo "<td> ".$taksimeter['Programska_verzija']."</</td>";
		echo "</tr>";

		//TABELA TARIF
		echo "<tr>";
			echo "<td colspan=4>";
				echo "<table border=1 width='100%'>";
					echo "<tr>";
					echo "<td>Preskok: </td>";
					echo "<td>".$taksimeter['Preskok']."</td>";
					echo "<td>EUR</td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "</tr>";
 	
					echo "<tr>";
					echo "<td>Tarifa: </td>";
					echo "<td>Vrsta: </td>";
					echo "<td>Startnina: </td>";
					echo "<td>KM/EUR</td>";
					echo "<td>Cakalna ura</td>";
					echo "<td>Startnina nocna</td>";
					echo "<td>KM/EUR nocni</td>";
					echo "<td>Cakalna ura nocna</td>";
					echo "</tr>";
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
				echo "</table>";
			echo "</td>";
		echo "</tr>";
		echo "<tr>";
		//echo "$mydate[month] $mydate[mday], $mydate[year]
			echo "<td> Datum posega:</td>";
			echo "<td> ".$mydate['mday']." ".$mydate['month']." ".$mydate['year']."</td>";
			echo "<td>Datum izdaje zapisnika: </td>";
			echo "<td> ".$mydate['mday']." ".$mydate['month']." ".$mydate['year']."</td>";
		echo "</tr>";
		
	echo "</table>";


	?>
</div>

	<!--<input type="button" value="kreiraj PDF"/>-->

</body>
</html>

