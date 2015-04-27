<?php
session_start();

if($_POST['Registrska_st']==""||$_POST['Tip_vozila']==""||$_POST['Dimenzije_pnevmatik']==""||$_POST['St_gum']==""||$_POST['St_sasije']==""||$_POST['Konstanta_vozila']==""||$_POST['ID_taksimeter']==""){
	$_SESSION['napaka']="VNOS NI BIL USPESEN: Neko polje je prazno.";
}
else{
		//vstavi v bazo
		$povezava = new mysqli("localhost", "root", "", "taksi_sluzba");//link na bazo
		if ($povezava->connect_errno) {
    		echo "Napaka: " . $mysqli->connect_error; // napise do kaksne napake je prislo
		}
		/*
		$poizvedba="SELECT * from taksimeter where Serijska_st='".$_POST['ID_taksimeter']."'";
		$rezultat=$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
		
		if($rezultat->num_rows==0){ // drustvo se ne obstaja
			$_SESSION['napaka']="VNOS NI BIL USPESEN: Taksimeter ne obstaja.";
		}
		*/

		else{
			
			$poizvedba="SELECT * from vozilo where Registrska_stevilka='".$_POST['Registrska_st']."'";
			$rezultat=$povezava->query($poizvedba);
			if($rezultat->num_rows!=0){ 
				$_SESSION['napaka']="VNOS NI BIL USPESEN: Vozilo s to registrsko ze obstaja.";
			}

			else{

				$poizvedba="SELECT * from vozilo where ID_taksimeter=".$_POST['ID_taksimeter']."";
				$rezultat=$povezava->query($poizvedba);
				if($rezultat->num_rows!=0){ 
					$vrstica = $rezultat->fetch_assoc(); // potegnes ven vrstico iz rezultata
					$reg=$vrstica['Registrska_stevilka']; //dobim id drustva ven
					$_SESSION['napaka']="VNOS NI BIL USPESEN: Vozilo z registrsko: <b>".$reg."</b> ze uporablja ta taksimeter.";
				}
				else{
					$poizvedba="INSERT INTO Vozilo (Registrska_stevilka, Tip_vozila, Dimenzije_pnevmatik, st_gum, st_sasije, Konstanta_vozila, ID_taksimeter) values ('".$_POST['Registrska_st']."','".$_POST['Tip_vozila']."','".$_POST['Dimenzije_pnevmatik']."','".$_POST['St_gum']."','".$_POST['St_sasije']."','".$_POST['Konstanta_vozila']."',".$ID_taksimeter.")"; 
					$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
					$_SESSION['uspesno']="Vnos je bil uspesen.";
				}
			}
		}
	}

header("location: vnosvozila.php");

?>