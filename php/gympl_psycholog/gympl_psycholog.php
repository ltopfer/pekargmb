<?php 
$soubor=__FILE__;
require "hlavicka.php";

  ?> 
 


<?php
echo"<h4>
   �koln� psycholog </h4> <br />";
 ?>  

 
 
 
 <?php  
$zobr=$_GET[zobr];
if ($zobr=='') {
echo"

  <div class=\"centrovano\">
<img src=\"logo.gif\" alt=\"logo\" border=\"0\"><br>

<br>  <hr> 
 

 <b> PhDr. Zuzana Knesplov�</b><br />
�koln� psycholo�ka Gymn�zia Dr. J. Peka�e <br />
<b>Tel.:</b>326 375 950  <br />
Mobil(pouze v konzulta�n�ch hodin�ch): 720 053 328   <br />
<b>Email:</b> <a href=\"mailto:knesplova@pekargmb.cz \">knesplova@pekargmb.cz </a>  <br />
<b>S�dlo: </b>Gymn�zium Dr. J. Peka�e, pracovna E06 (1. mezipatro, trakt estetiky)  <br />
<table width=\"50%\" border=\"0\">
<caption><b>Konzulta�n� hodiny:</b></caption>
 
     <tr>
    <td>Po</td>
    <td align=\"left\" colspan=\"2\"> 7.00 � 9. 00  &nbsp;&nbsp;11.30 � 14.30  </td>   
  </tr>
  <tr> 
 
    <tr>
    <td>�t</td>
    <td align=\"left\" colspan=\"2\">  7.00 � 8.00   &nbsp;&nbsp;&nbsp; 9.30 � 14.00 </td>   
  </tr>                                                          
  <tr>
  
    <td >St</td>
    <td align=\"left\" colspan=\"2\">  8.30 � 15.00</td>   
  </tr>

     <tr>
    <td >�t	</td>
    <td align=\"left\" colspan=\"2\">   7.00 � 14.00</td>  
  </tr>
  
  <tr>
    <td>P�</td>
    <td align=\"left\" colspan=\"2\">  7.00 - 14.00  </td>   
  </tr>
</table>	
<i>V p��pad� z�jmu o konzultaci se pros�m v�dy p�edem objednejte 
(emailem, osobn�, telefonicky, smskou)...</i>
</div>

<br />
";
                  }
 $pro_vypis=new CRubrika_Foto('gympl_psycholog');
 $pro_vypis->NastavAdresarFotek('foto/');                                   
$pro_vypis->FormatujObashRubriky($zobr); 




require "paticka.php";
?>

    
