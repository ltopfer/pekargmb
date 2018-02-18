<?php
$soubor=__FILE__;
require "hlavicka.php";
if ((date("n")>=8)&&(date("n")<=12)) {
$rok=date("Y");$dalsirok=$rok+1;
$skolnirok=$rok.'/'.$dalsirok;  

}
else {
$rok=date("Y");$predchozirok=$rok-1;
$skolnirok=$predchozirok.'/'.$rok;
}
echo "  <h4>Školní øád $skolnirok</h4> "
?>  
  
Podle zákona è.561/2004 Sb.ze dne 24. záøí 2004 o pøedškolním, základním, støedním, vyšším odborném a jiném vzdìlávání (školský zákon) § 30 vydává øeditel Gymnázia Dr. Josefa školní øád.<br>
Tento dokument se skládá z následujících pøíloh:<br>
<hr>

 
 <?php 
 require '../gympl_rady/crady.php';
  $zobr=$_GET[zobr];

 
 $pro_vypis=new CRubrika_Foto('gympl_rady');
 $pro_vypis->NastavAdresarFotek('../gympl_rady/pdfsoubory/');                                   
$pro_vypis->FormatujObashRubriky($zobr);
?>
<br>
        
   <?php
require "paticka.php";
?>
