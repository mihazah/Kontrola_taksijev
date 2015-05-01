<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vnos voznika</title>

	<link rel="stylesheet" type="text/css" href="stil.css">
</head>
<body>
<div id="centriranaForma">
	<h1>VNOS VOZNIKA</h1>
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
	<form action="vnesivoznika.php" method="POST">
		<table>
			<tr>
				<td>Ime :</td><td><input type="text" name="Ime"></td> 
			</tr>
			<tr>
				<td>Priimek:</td><td><input type="text" name="Priimek"></td>
			</tr>
			<tr>
				<td>Davcna.st:</td><td><input type="text" name="Davcna"></td>
			</tr> 
			<tr>
				<td>Tel.st:</td><td><input type="text" name="Tel"></td>
			</tr> 
			<tr>
				<td>Ime drustva:</td>
				<td>
					<select name="ID_Drustvo">
						<?php  
							$povezava = new mysqli("localhost", "root", "", "taksi_sluzba");//link na bazo
							if ($povezava->connect_errno) {
					    		echo "Napaka: " . $mysqli->connect_error; // napise do kaksne napake je prislo
							}

							$poizvedba="SELECT ID_taksi_drustva, Ime_drustva from taksi_drustvo";
							$rezultat=$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
							while($vrstica = $rezultat->fetch_assoc()){
								echo '<option value="'.$vrstica['ID_taksi_drustva'].'">'.$vrstica['Ime_drustva'].'</option>';		
							}
							
						?>
					</select> 
				</td>
			</tr> 
		</table>
		<input type="submit" value="Dodaj voznika">

	</form>
</div>

</body>
</html>