<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vnos vozila</title>

	<link rel="stylesheet" type="text/css" href="stil.css">
</head>
<body>
<div id="centriranaForma">
	<h1>VNOS VOZILA</h1>
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
	<form action="vnesivozilo.php" method="POST">
		<table>
			<tr>
				<td>Registrska stevilka :</td><td><input type="text" name="Registrska_st" placeholder="npr. abc-123" required></td> 
			</tr>
			<tr>
				<td>Tip vozila:</td><td><input type="text" name="Tip_vozila"></td>
			</tr>
			<tr>
				<td>Dimenzije pnevmatik:</td><td><input type="text" name="Dimenzije_pnevmatik"></td>
			</tr> 
			<tr>
				<td>Stevilo gum:</td><td><input type="number" value="4" min="2" max="20" name="St_gum" ></td>
			</tr> 
			<tr>
				<td>Stevilka sasije:</td><td><input type="text" name="St_sasije"></td>
			</tr> 
			<tr>
				<td>Konstanta vozila:</td><td><input type="text" name="Konstanta_vozila"></td>
			</tr>
			<tr>
				<td>Serijska st. taksimetra:</td><td><input type="text" name="Serijska_st"></td>
			</tr>
		</table>
		<input type="submit" value="Dodaj vozilo">

	</form>
</div>

</body>
</html>