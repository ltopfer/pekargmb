<?php 
$soubor=__FILE__;
require "hlavicka.php";

  ?> 
 


<?php
echo"<h4>
   Školní psycholog </h4> <br />";
 ?>  

 
 
 
 <?php  
$zobr=$_GET[zobr];
if ($zobr=='') {
echo"

  <div class=\"centrovano\">
<img src=\"logo.gif\" alt=\"logo\" border=\"0\"><br>

<br>  <hr> 
 

 <b> PhDr. Zuzana Knesplová</b><br />
Školní psycholožka Gymnázia Dr. J. Pekaøe <br />
<b>Tel.:</b>326 375 950  <br />
Mobil(pouze v konzultaèních hodinách): 720 053 328   <br />
<b>Email:</b> <a href=\"mailto:knesplova@pekargmb.cz \">knesplova@pekargmb.cz </a>  <br />
<b>Sídlo: </b>Gymnázium Dr. J. Pekaøe, pracovna E06 (1. mezipatro, trakt estetiky)  <br />
<table width=\"50%\" border=\"0\">
<caption><b>Konzultaèní hodiny:</b></caption>
 
     <tr>
    <td>Po</td>
    <td align=\"left\" colspan=\"2\"> 7.00 – 9. 00  &nbsp;&nbsp;11.30 – 14.30  </td>   
  </tr>
  <tr> 
 
    <tr>
    <td>Út</td>
    <td align=\"left\" colspan=\"2\">  7.00 – 8.00   &nbsp;&nbsp;&nbsp; 9.30 – 14.00 </td>   
  </tr>                                                          
  <tr>
  
    <td >St</td>
    <td align=\"left\" colspan=\"2\">  8.30 – 15.00</td>   
  </tr>

     <tr>
    <td >Èt	</td>
    <td align=\"left\" colspan=\"2\">   7.00 – 14.00</td>  
  </tr>
  
  <tr>
    <td>Pá</td>
    <td align=\"left\" colspan=\"2\">  7.00 - 14.00  </td>   
  </tr>
</table>	
<i>V pøípadì zájmu o konzultaci se prosím vždy pøedem objednejte 
(emailem, osobnì, telefonicky, smskou)...</i>
</div>

<br />
";
                  }
 $pro_vypis=new CRubrika_Foto('gympl_psycholog');
 $pro_vypis->NastavAdresarFotek('foto/');                                   
$pro_vypis->FormatujObashRubriky($zobr); 




require "paticka.php";
?>

    
