<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vnos vrste tarife</title>

	<link rel="stylesheet" type="text/css" href="stil.css">
</head>
<body>
<div id="centriranaForma">
	<h1>VNOS VRSTE TARIFE</h1>
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
	<form action="vnesitarifo.php" method="POST">
		<table>
			<tr>
				<td>Vrsta:</td><td><input type="text" name="Vrsta"></td> 
			</tr>
			<tr>
				<td>Startnina:</td><td><input type="text" name="Startnina"></td>
			</tr>
			<tr>
				<td>Voznja km:</td><td><input type="text" name="Voznja_km"></td>
			</tr> 
			<tr>
				<td>Cakalna ura:</td><td><input type="text" name="Cakalna_ura"></td>
			</tr>
			<tr>
				<td>Startnina nocna:</td><td><input type="text" name="Startnina_nocna"></td>
			</tr>
			<tr>
				<td>Cakalna ura nocna:</td><td><input type="text" name="Cakalna_ura_nocna"></td>
			</tr>
			<tr>
				<td>Voznja km nocna:</td><td><input type="text" name="Voznja_km_nocna"></td>
			</tr>
		</table>
		<input type="submit" value="Dodaj tarifo">

	</form>
</div>

</body>
</html>