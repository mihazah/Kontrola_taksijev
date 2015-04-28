<?php
session_start();

if($_POST['Proizvajalec']==""||$_POST['Tip']==""||$_POST['Oznaka']==""||$_POST['Serijska']==""||$_POST['Prog_verzija']==""||$_POST['Preskok']==""){
	$_SESSION['napaka']="VNOS NI BIL USPESEN: Neko polje je prazno.";
}
else{
		//vstavi v bazo
		$povezava = new mysqli("localhost", "root", "", "taksi_sluzba");//link na bazo
		if ($povezava->connect_errno) {
    		echo "Napaka: " . $mysqli->connect_error; // napise do kaksne napake je prislo
		}

		
		$poizvedba="SELECT * from taksimeter where Serijska_st='".$_POST['Serijska']."'";
		$rezultat=$povezava->query($poizvedba);
		if($rezultat->num_rows!=0){ 
			$_SESSION['napaka']="VNOS NI BIL USPESEN: Taksimeter ze obstaja.";
		}
		else{
			$poizvedba="INSERT INTO taksimeter (Proizvajalec, Tip_taksimetra, Uradna_oznaka, Serijska_st, Programska_verzija, Preskok) values ('".$_POST['Proizvajalec']."','".$_POST['Tip']."','".$_POST['Oznaka']."','".$_POST['Serijska']."','".$_POST['Prog_verzija']."', ".$_POST['Preskok'].")"; 
			$povezava->query($poizvedba); // izvede sql kodo (poizvedbe)
			$_SESSION['uspesno']="Vnos je bil uspesen.";
		}
		
	}

header("location: vnostaximetra.php");

?>