<?php 
$soubor=__FILE__;
require 'hlavicka.php';
?>
<div class="nasinej">
<?php
require 'cnasinej_zobr.php';
  ?> 
 


<?php
echo"<h4> Nejlepší studenti".$hodnotasloupce." </h4> <br /> ";?>

  <br>
 <?php
$zobr=$_GET[zobr];

 
 $pro_vypis=new CRubrika_Foto('gympl_nasinej');
 $pro_vypis->NastavAdresarFotek('../gympl_nasinej/foto/');                                   
$pro_vypis->FormatujObashRubriky($zobr); 

?>    
</div>
<?php


require "paticka.php";
?>

    
