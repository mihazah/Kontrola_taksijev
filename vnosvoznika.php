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
				<td>Ime drustva:</td><td><input type="text" name="Drustvo"></td>
			</tr> 
		</table>
		<input type="submit" value="Dodaj drustvo">

	</form>
</div>

</body>
</html>