<?php 
$soubor=__FILE__;
require "hlavicka.php";

  ?> 
 


<?php
echo"<h4> V�chovn� poradce  </h4> <br />";
  
$zobr=$_GET[zobr];
if ($zobr=='') {
echo"
<div class=\"centrovano\">
 

  <b>Mgr. Dana Pato�kov�</b> <br>
  <table width=\"90%\" align=\"center\" border=\"0\">
    <tr align=\"left\"> <td align=\"left\"><b>kabinet �. 117 </b>� tel. 326375957 <br></td></tr>
    <tr align=\"left\"> <td align=\"left\"><b>kabinet �. 302 </b>- tel. 326375974 � <b>konzulta�n� hodiny:</b> st�eda � 11.40 � 13.25 <br></td></tr>
    <tr align=\"left\"> <td align=\"left\"><b>Email:</b> <a href=\"mailto:patockova@pekargmb.cz \">patockova@pekargmb.cz </a><br></td></tr>
  </table>



<hr>

</div>
<b>��k�m �koly a jejich rodi��m je poskytov�na v�chovnou poradkyn� poradensk� pomoc:  
</b>
 <ul>
   <li> p�i �e�en� r�zn�ch v�chovn�ch, prosp�chov�ch a dal��ch probl�m� (probl�my v osobn�ch vztaz�ch nebo ve vztaz�ch se spolu��ky, neprosp�ch ve �kole, probl�my se zvl�d�n�m u�iva, ot�zky volby pomaturitn�ho studia); 
</li>
   <li>v problematice inkluz�vn�ho vzd�l�v�n� na gymn�ziu (tj. vzd�l�v�n� ��k� se speci�ln�mi vzd�l�vac�mi pot�ebami a ��k� nadan�ch), a to ve spolupr�ci s pedagogicko-psychologickou poradnou a speci�ln�m pedagogick�m centrem, s t��dn�m u�itelem a u�iteli jednotliv�ch p�edm�t�;  
 </li>
   <li>p�i �e�en� probl�m� spojen�ch se soci�ln� patologick�mi jevy (u��v�n� n�vykov�ch l�tek, �ikana, z�kol�ctv�, patologick� hr��stv�, poruchy p��jmu potravy, �). 
</li>
 </ul>

  <br>
<b>��k�m �koly a jejich rodi��m jsou poskytov�ny v�chovnou poradkyn� informace:  
</b> <br><br>
 <ul>
   <li> o p�ij�mac�m ��zen� na gymn�zium, form� studia a zam��en�; 
</li>
   <li> o mo�nostech dal��ho studia na V� a VO� � informa�n� materi�ly, p�ihl�ky na �koly a term�ny jejich pod�n�, informace o �sp�nosti p�i p�ij�mac�ch zkou�k�ch; 
</li>
   <li> o dal��ch organizac�ch, kter� ��k�m a jejich rodi��m mohou poskytnout odbornou pomoc p�i �e�en� osobn�ch nebo rodinn�ch probl�m�. 
</li>
 </ul>


<hr>



";
	
}
 
 $pro_vypis=new CRubrika_Foto('gympl_poradce');
 $pro_vypis->NastavAdresarFotek('foto/');                                   
$pro_vypis->FormatujObashRubriky($zobr); 




require "paticka.php";
?>

    
