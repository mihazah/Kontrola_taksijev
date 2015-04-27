<?php
session_start();

if($_POST['Ime']==""||$_POST['Priimek']==""||$_POST['Tel']==""||$_POST['Davcna']==""||$_POST['ID_Drustvo']==""){
	$_SESSION['napaka']="VNOS NI BIL USPESEN: Neko polje je prazno.";
}
else{
		//vstavi v bazo
		$povezava = new mysqli("localhost", "root", "", "taksi_sluzba");//link na bazo
		if ($povezava->connect_errno) {
    		echo "Napaka: " . $mysqli->connect_error; // napise do kaksne napake je prislo
		}

		$poizvedba="SELECT * from voznik where Davcna_st='".$_POST['Davcna']."'";
		$rezultat=$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
		$vrstica = $rezultat->fetch_assoc(); 
		if($rezultat->num_rows!=0){ // drustvo se ne obstaja
			$_SESSION['napaka']="VNOS NI BIL USPESEN: Voznik s tako davČno ze obstaja.";
		}
		else{
				$poizvedba="INSERT INTO voznik (Ime, Priimek, Davcna_st, Telefon, ID_taksi_drustva) values ('".$_POST['Ime']."','".$_POST['Priimek']."','".$_POST['Davcna']."','".$_POST['Tel']."',".$_POST['ID_Drustvo'].")"; //$drustvo je id drustva
				$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
				$_SESSION['uspesno']="Vnos je bil uspesen.";
			}

		/*
		$poizvedba="SELECT * from taksi_drustvo where Ime_drustva='".$_POST['Drustvo']."'";
		$rezultat=$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
		
		if($rezultat->num_rows==0){ // drustvo se ne obstaja
			$_SESSION['napaka']="VNOS NI BIL USPESEN: Drustvo ne obstaja.";
		}
		else{
			$vrstica = $rezultat->fetch_assoc(); // potegnes ven vrstico iz rezultata
			$drustvo=$vrstica['ID_taksi_drustva']; //dobim id drustva ven
			$poizvedba="SELECT * from voznik where Ime='".$_POST['Ime']."' AND Priimek='".$_POST['Priimek']."'";
			$rezultat=$povezava->query($poizvedba);
			if($rezultat->num_rows!=0){ 
				$_SESSION['napaka']="VNOS NI BIL USPESEN: Voznik ze obstaja.";
			}
			else{
				$poizvedba="INSERT INTO voznik (Ime, Priimek, Davcna_st, Telefon, ID_taksi_drustva) values ('".$_POST['Ime']."','".$_POST['Priimek']."','".$_POST['Davcna']."','".$_POST['Tel']."',".$drustvo.")"; //$drustvo je id drustva
				$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
				$_SESSION['uspesno']="Vnos je bil uspesen.";
			}
		}
		*/
	}

header("location: vnosvoznika.php");

?>