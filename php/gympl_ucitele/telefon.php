 <?php
 $soubor=__FILE__;
require "hlavicka.php";

 $pro_vypis=new CRubrika_Foto('gympl_telefony');
                                
$pro_vypis->Formatuj_tel_seznam(); 
?>

<?php
require "paticka.php";
?>
