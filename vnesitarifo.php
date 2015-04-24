<?php
session_start();

if($_POST['Vrsta']==""||$_POST['Startnina']==""||$_POST['Voznja_km']==""||$_POST['Cakalna_ura']==""||$_POST['Startnina_nocna']==""||$_POST['Cakalna_ura_nocna']==""||$_POST['Voznja_km_nocna']==""){
	$_SESSION['napaka']="VNOS NI BIL USPESEN: Neko polje je prazno.";
}
else{
		//vstavi v bazo
		$povezava = new mysqli("localhost", "root", "", "taksi_sluzba");//link na bazo
		if ($povezava->connect_errno) {
    		echo "Napaka: " . $mysqli->connect_error; // napise do kaksne napake je prislo
		}

		
		$poizvedba="SELECT * from vrsta_tarife where Vrsta='".$_POST['Vrsta']."'";
		$rezultat=$povezava->query($poizvedba);
		if($rezultat->num_rows!=0){ 
			$_SESSION['napaka']="VNOS NI BIL USPESEN: Vrsta ze obstaja.";
		}
		else{
			$poizvedba="INSERT INTO Vrsta_tarife (Vrsta, Startnina, Voznja_km, Cakalna_ura, Startnina_nocna, Cakalna_ura_nocna, Voznja_km_nocna) values ('".$_POST['Vrsta']."',".$_POST['Startnina'].",".$_POST['Voznja_km'].",".$_POST['Cakalna_ura'].",".$_POST['Startnina_nocna'].",".$_POST['Cakalna_ura_nocna'].",".$_POST['Voznja_km_nocna'].")"; 
			$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
			$_SESSION['uspesno']="Vnos je bil uspesen.";
		}
		
	}

header("location: vnostarife.php");

?>