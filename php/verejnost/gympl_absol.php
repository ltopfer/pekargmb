<?php 
$soubor=__FILE__;
require 'hlavicka.php';
?>
<div class="absolventi">
<?php
require 'cabsol_zobr.php';
  ?> 
 


<?php
echo"<h4>Galerie významných absolventù školy</h4> <br />
Za vznikem této rubriky stojí projekt studentù Gymnázia Dr. J. Pekaøe, kteøí se rozhodli v rámci volitelných semináøù stylistiky zpracovat medailony zajímavých osobností z øad absolventù své školy.  Následnì se tedy budete setkávat s žijícími osobnostmi, jež jsou ve svém oboru úspìšní. Skladba osobností bude velmi pestrá, mùžete se tedy tìšit na politiky, lékaøe, sportovce …

";
$zobr=$_GET[zobr];

 
 $pro_vypis=new CRubrika_Foto('gympl_absol');
 $pro_vypis->NastavAdresarFotek('../gympl_absol/foto/');                                   
$pro_vypis->FormatujObashRubriky($zobr); 


?>    
</div>
<?php

require "paticka.php";
?>

    
