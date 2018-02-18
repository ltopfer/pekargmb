<?php 
$soubor=__FILE__;
require "hlavicka.php";

  ?> 
 


<?php
$zobr=$_GET[zobr];

 
 $pro_vypis=new CRubrika_Foto('gympl_novinky');
 $pro_vypis->NastavAdresarFotek('foto/');                                   
$pro_vypis->FormatujObashRubriky($zobr,$filtrovanysloupec,$mahodnotu,'poradi DESC,id DESC'); 




require "paticka.php";
?>

    
