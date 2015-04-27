<?php
session_start();

if($_POST['Id_Voznika']==""||$_POST['ID_vozila']==""||$_POST['Id_Tarife']==""||$_POST['Datum_dvig']==""||$_POST['Datum_dostave']==""){
	$_SESSION['napaka']="VNOS NI BIL USPESEN: Neko polje je prazno.";
	//posiljam cez id-je, zaradi lazjega dostopa do drugih tabel
}
else{
		//vstavi v bazo
		$povezava = new mysqli("localhost", "root", "", "taksi_sluzba");//link na bazo
		if ($povezava->connect_errno) {
    		echo "Napaka: " . $mysqli->connect_error; // napise do kaksne napake je prislo
		}

		$poizvedba="INSERT INTO Voznja (Datum_dviga, Datum_dostave, ID_vozila, ID_voznika, Id_tarife) values ('".$_POST['Datum_dvig']."','".$_POST['Datum_dostave']."',".$_POST['ID_vozila'].",".$_POST['Id_Voznika'].",".$_POST['Id_Tarife'].")"; 
		$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
		$_SESSION['uspesno']="Vnos je bil uspesen.";

		/*
		$poizvedba="SELECT * from vozilo where Registrska_stevilka='".$_POST['Registrska']."'";
		$rezultat=$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
		
		if($rezultat->num_rows==0){ // drustvo se ne obstaja
			$_SESSION['napaka']="VNOS NI BIL USPESEN: To vozilo ne obstaja.";
		}
		else{
			$vrstica = $rezultat->fetch_assoc(); // potegnes ven vrstico iz rezultata
			$ID_vozila=$vrstica['ID_vozila']; //dobim id drustva ven

			$poizvedba="SELECT * from voznik where Ime='".$_POST['Ime']."' AND Priimek='".$_POST['Priimek']."'";
			$rezultat=$povezava->query($poizvedba);
			if($rezultat->num_rows==0){ 
				$_SESSION['napaka']="VNOS NI BIL USPESEN: Voznik ne obstaja.";
			}
			else{
				$vrstica = $rezultat->fetch_assoc(); // potegnes ven vrstico iz rezultata
				$ID_voznika=$vrstica['ID_voznika']; 

				$poizvedba="SELECT * from vrsta_tarife where Vrsta='".$_POST['Tarifa']."'";
				$rezultat=$povezava->query($poizvedba);
				if($rezultat->num_rows==0){ 
					$_SESSION['napaka']="VNOS NI BIL USPESEN: Tarifa ne obstaja.";
				}

				else{
					$vrstica = $rezultat->fetch_assoc(); // potegnes ven vrstico iz rezultata
					$ID_tarife=$vrstica['Id_tarife']; 

					$poizvedba="INSERT INTO Voznja (Datum_dviga, Datum_dostave, ID_vozila, ID_voznika, Id_tarife) values ('".$_POST['Datum_dvig']."','".$_POST['Datum_dostave']."',".$ID_vozila.",".$ID_voznika.",".$ID_tarife.")"; 
					$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
					$_SESSION['uspesno']="Vnos je bil uspesen.";
				}
			}
		}
		*/
	}

header("location: vnosvoznja.php");

?>