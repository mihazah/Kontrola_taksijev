<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vnos voznje</title>

	<link rel="stylesheet" type="text/css" href="stil.css">
</head>
<body>
<div id="centriranaForma">
	<h1>VNOS VOZNJE</h1>
	<?php
	if(isset($_SESSION['napaka'])){
		echo '<span id="napaka">'.$_SESSION['napaka']."</span>";
		unset($_SESSION['napaka']);
	}
	else if(isset($_SESSION['uspesno'])){
		echo '<span id="uspesno">'.$_SESSION['uspesno']."</span>";
		unset($_SESSION['uspesno']);
	}
	?>
	<form action="vnesivoznjo.php" method="POST">
		<table>
			<tr>
			<td>Ime in priimek:</td>
				<td><select name="Id_Voznika">
						<?php  
							$povezava = new mysqli("localhost", "root", "", "taksi_sluzba");//link na bazo
							if ($povezava->connect_errno) {
					    		echo "Napaka: " . $mysqli->connect_error; // napise do kaksne napake je prislo
							}

							$poizvedba="SELECT Id_Voznika, Ime, Priimek from voznik";
							$rezultat=$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
							while($vrstica = $rezultat->fetch_assoc()){
								echo '<option value="'.$vrstica['Id_Voznika'].'">'.$vrstica['Ime'].' '.$vrstica['Priimek'].'</option>';
							}
							
						?>
					</select> 
					</td>
			</tr>
			
			<tr>
				<td>Registrska stevilka:</td>
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
			<tr>
				<td>Vrsta tarife:</td>
				<td>
					<select name="Id_Tarife">
						<?php  
							$povezava = new mysqli("localhost", "root", "", "taksi_sluzba");//link na bazo
							if ($povezava->connect_errno) {
					    		echo "Napaka: " . $mysqli->connect_error; // napise do kaksne napake je prislo
							}

							$poizvedba="SELECT Id_tarife, Vrsta from vrsta_tarife";
							$rezultat=$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
							while($vrstica = $rezultat->fetch_assoc()){
								echo '<option value="'.$vrstica['Id_tarife'].'">'.$vrstica['Vrsta'].'</option>';		
							}
							
						?>
					</select> 
				</td>
			</tr> 
			<tr>
				<td>Datum in cas dviga:</td><td><input type="text" name="Datum_dvig"></td>
			</tr> 
			<tr>
				<td>Datum in cas dostave:</td><td><input type="text" name="Datum_dostave"></td>
			</tr>
			
		</table>
		<input type="submit" value="Dodaj voznjo">
	</form>
</div>

</body>
</html>