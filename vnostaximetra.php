<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vnos taksimetra</title>

	<link rel="stylesheet" type="text/css" href="stil.css">
</head>
<body>
<div id="centriranaForma">
	<h1>VNOS TAXIMETRA</h1>
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
	<form action="vnesitaximeter.php" method="POST">
		<table>
			<tr>
				<td>Proizvajalec:</td><td><input type="text" name="Proizvajalec"></td> 
			</tr>
			<tr>
				<td>Tip taksimetra:</td><td><input type="text" name="Tip"></td>
			</tr>
			<tr>
				<td>Uradna oznaka:</td><td><input type="text" name="Oznaka"></td>
			</tr> 
			<tr>
				<td>Serijska st.:</td><td><input type="text" name="Serijska"></td>
			</tr> 
			<tr>
				<td>Programska verzija:</td><td><input type="text" name="Prog_verzija"></td>
			</tr> 
		</table>
		<input type="submit" value="Dodaj taximeter">

	</form>
</div>

</body>
</html>