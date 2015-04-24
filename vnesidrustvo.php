<?php
session_start();

if($_POST['Ime']==""||$_POST['Naslov']==""||$_POST['Tel']==""){
	$_SESSION['napaka']="VNOS NI BIL USPESEN: Neko polje je prazno.";
}
else{
		//vstavi v bazo
		$povezava = new mysqli("localhost", "root", "", "taksi_sluzba");//link na bazo
		if ($povezava->connect_errno) {
    		echo "Napaka: " . $mysqli->connect_error; // napise do kaksne napake je prislo
		}

		$poizvedba="SELECT * from taksi_drustvo where Ime_drustva='".$_POST['Ime']."'";
		$rezultat=$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
		if($rezultat->num_rows!=0){
			$_SESSION['napaka']="VNOS NI BIL USPESEN: Ime ze obstaja.";
		}
		else{
			$poizvedba="INSERT INTO taksi_drustvo (Ime_drustva, Naslov_drustva, Tel_st) values ('".$_POST['Ime']."','".$_POST['Naslov']."','".$_POST['Tel']."')";
			$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
			$_SESSION['uspesno']="Vnos je bil uspesen.";
		}
	}

header("location: vnosdrustva.php");

?>