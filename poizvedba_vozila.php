<?php
	session_start();
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
	if(isset($_SESSION['napaka'])){
		echo '<span id="napaka">'.$_SESSION['napaka']."</span>";
		unset($_SESSION['napaka']);
	}
	?>
	<form action="izpis_vozila.php" method="POST">
		<table>
			<tr>
				<td>Registrska stevilka vozila:</td>
				<td>
					<select name="ID_vozila">
						<?php  
							$povezava = new mysqli("localhost", "root", "", "taksi_sluzba");//link na bazo
							if ($povezava->connect_errno) {
					    		echo "Napaka: " . $mysqli->connect_error; // napise do kaksne napake je prislo
							}

							$poizvedba="SELECT ID_vozila, Registrska_stevilka from vozilo";
							$rezultat=$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
							while($vrstica = $rezultat->fetch_assoc()){
								echo '<option value="'.$vrstica['ID_vozila'].'">'.$vrstica['Registrska_stevilka'].'</option>';

							}
						?>
					</select> 
				</td>

			</tr>
		</table>
		<input type="submit" value="Izpisi vozilo">

	</form>
</div>

</body>
</html>