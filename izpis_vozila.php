<?php
	session_start();
	if($_POST['ID_vozila']==""){
		$_SESSION['napaka']="VNOS NI BIL USPESEN: Neko polje je prazno.";
		header("location: poizvedba_vozila.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>POIZVEDBA ZA VOZILA</title>

	<link rel="stylesheet" type="text/css" href="stil.css">
</head>
<body>
<div id="centriranaForma">
	<h1>POIZVEDBA ZA VOZILA</h1>
	<?php
	$povezava = new mysqli("localhost", "root", "", "taksi_sluzba");//link na bazo
		if ($povezava->connect_errno) {
    		echo "Napaka: " . $mysqli->connect_error; // napise do kaksne napake je prislo
		}
	$poizvedba="SELECT Registrska_stevilka, Tip_vozila FROM vozilo WHERE ID_vozila=".$_POST['ID_vozila'];
	$rezultat=$povezava->query($poizvedba);
	$vrstica = $rezultat->fetch_assoc(); // potegnes ven vrstico iz rezultata

	echo "<table>";
		echo "<tr>";
			echo"<td>Serijska st. taksimetra:</td>";
			echo "<td>";
				echo $vrstica['Registrska_stevilka']; // zberes ker stolpec iz tabele ti bo izpisu
			echo "</td>";

		echo "</tr>";
	echo "</table>";

	?>
</div>

</body>
</html>

