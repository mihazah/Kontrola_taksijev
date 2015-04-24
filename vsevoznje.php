<?php

	$povezava = new mysqli("localhost", "root", "", "taksi_sluzba");//link na bazo
	if ($povezava->connect_errno) {
		echo "Napaka: " . $mysqli->connect_error; // napise do kaksne napake je prislo
	}

	$poizvedba="SELECT v.Datum_dviga, v.Datum_dostave, voz.Ime, voz.Priimek, vrs.Vrsta, vozilo.Tip_vozila  
	FROM voznja v inner join voznik voz on (v.ID_voznika=voz.ID_voznika) 
	INNER join vrsta_tarife vrs on (v.Id_tarife=vrs.Id_tarife) 
	INNER join vozilo on (vozilo.ID_vozila=v.ID_vozila)
	
	";

	
	$rezultat=$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
	while($vrstica=$rezultat->fetch_assoc()){
		print_r($vrstica);
		echo '<br/>';
	}

?>