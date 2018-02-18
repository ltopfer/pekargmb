<?php 
$soubor=__FILE__;
require "hlavicka.php";

  ?> 
 


<?php
echo"<h4> Seznam zamìstnancù  ".$hodnotasloupce." </h4>";
$zobr=$_GET[zobr];

 
 $pro_vypis=new CRubrika_Foto('gympl_ucitele');
 $pro_vypis->NastavAdresarFotek('foto/');                                   
$pro_vypis->FormatujObashRubriky($zobr,$sloupec,$hodnotasloupce); 




require "paticka.php";
?>

    
