<?php
    require('phpToPDF.php');

    //Your HTML in a variable
    //$my_html="<HTML><h2>PDF from HTML using phpToPDF</h2></HTML>";


 $povezava = new mysqli("localhost", "root", "", "taksi_sluzba");//link na bazo
    if ($povezava->connect_errno) {
        echo "Napaka: " . $mysqli->connect_error; // napise do kaksne napake je prislo
    }
    /*
  $poizvedba="SELECT Registrska_stevilka, Tip_vozila FROM vozilo WHERE ID_vozila=".$_POST['ID_vozila'];
  $rezultat=$povezava->query($poizvedba);
  $vrstica = $rezultat->fetch_assoc(); // potegnes ven vrstico iz rezultata
  */

  /*
  $poizvedba="SELECT Proizvajalec, Tip_taksimetra, Serijska_st, Programska_verzija, Preskok, Uradna_oznaka  FROM taksimeter WHERE ID_taksimeter=".$_POST['ID_taksimetra'];
  $rezultat=$povezava->query($poizvedba);
  $taksimeter = $rezultat->fetch_assoc(); // potegnes ven vrstico iz rezultata


  $poizvedba="SELECT Registrska_stevilka, Tip_vozila, Dimenzije_pnevmatik, st_sasije, Konstanta_vozila FROM vozilo WHERE ID_taksimeter=".$_POST['ID_taksimetra'];
  $rezultat=$povezava->query($poizvedba);
  $vozilo = $rezultat->fetch_assoc(); //vemo da je samo 1 vrstica

  $poizvedba="SELECT Vrsta, Startnina, Voznja_km, Cakalna_ura, Startnina_nocna, Cakalna_ura_nocna, Voznja_km_nocna FROM Vrsta_tarife";
  $tarife=$povezava->query($poizvedba); //dobimo več tarif ven, z while bomo pobirali ven vrstice(vrednosti)
    $mydate=getdate(date("U"));
*/
    
$html= "<table>";
    $html.= "<tr>";
      $html.= "<td colspan=4><h1>Zapisnik o vgradnji in nastavitvi  taksimetra s serijsko st: serijska st</h1></td>";
    $html.= "</tr>";
    //VOZILO
    $html.= "<tr>";
      $html.= "<td><b> Vozilo</b></td>";
    $html.= "</tr>";

    $html.= "<tr>";
      $html.= "<td width='15%'> Tip vozila:</td>";
      $html.= "<td width='35%'> ".$vozilo['Tip_vozila']."</td>";
      $html.= "<td width='15%'>Registrska stevilka: </td>";
      $html.= "<td width='35%'> ".$vozilo['Registrska_stevilka']."</td>";
    $html.= "</tr>";
    $html.= "<tr>";
      $html.= "<td> Stevilka sasije: </td>";
      $html.= "<td> ".$vozilo['st_sasije']."</td>";
      $html.= "<td> Konstanta vozila W: </td>";
      $html.= "<td> ".$vozilo['Konstanta_vozila']."</td>";
    $html.= "</tr>";
    $html.= "<tr>";
      $html.= "<td> Dimenzije pnevmatik: </td>";
      $html.= "<td colspan=3> ".$vozilo['Dimenzije_pnevmatik']."</td>";
    $html.= "</tr>";

    //Set Your Options -- we are saving the PDF as 'my_filename.pdf' to a 'my_pdfs' folder
    $pdf_options = array(
      "source_type" => 'html',
      "source" => $html,
      "action" => 'save',
      "save_directory" => 'my_pdfs',
      "file_name" => 'my_filename.pdf');

    //Code to generate PDF file from options above
    phptopdf($pdf_options);
?>