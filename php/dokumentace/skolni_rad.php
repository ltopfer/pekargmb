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
echo "  <h4>�koln� ��d $skolnirok</h4> "
?>  
  
Podle z�kona �.561/2004 Sb.ze dne 24. z��� 2004 o p�ed�koln�m, z�kladn�m, st�edn�m, vy���m odborn�m a jin�m vzd�l�v�n� (�kolsk� z�kon) � 30 vyd�v� �editel Gymn�zia Dr. Josefa �koln� ��d.<br>
Tento dokument se skl�d� z n�sleduj�c�ch p��loh:<br>
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
