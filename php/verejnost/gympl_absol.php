<?php 
$soubor=__FILE__;
require 'hlavicka.php';
?>
<div class="absolventi">
<?php
require 'cabsol_zobr.php';
  ?> 
 


<?php
echo"<h4>Galerie v�znamn�ch absolvent� �koly</h4> <br />
Za vznikem t�to rubriky stoj� projekt student� Gymn�zia Dr. J. Peka�e, kte�� se rozhodli v r�mci voliteln�ch semin��� stylistiky zpracovat medailony zaj�mav�ch osobnost� z �ad absolvent� sv� �koly.  N�sledn� se tedy budete setk�vat s �ij�c�mi osobnostmi, je� jsou ve sv�m oboru �sp�n�. Skladba osobnost� bude velmi pestr�, m��ete se tedy t�it na politiky, l�ka�e, sportovce �

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

    
