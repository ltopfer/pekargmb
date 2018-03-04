<?php
 require("crubrika_bez_foto.php");
$sloupec=$_GET[sloupec];$hodnotasloupce=$_GET[hodnotasloupce];
$zobr=$_GET[zobr];$vyber=$zobr;
$kategorie=$adresar_instalace;$kategorie_nazav=$nazev_instalace.'-výbìr volitelných pøedmìtù';
$tabulka=$pref.'zaci';
 
require '../../hlavicka.php';
require '../../menu.php';

     
 
 echo"

 <div id=\"pravy-sloupec-uzky\">
 <div class=\"podmenu\">
  <h5> $kategorie_nazav </h5> 

 <a href=\"editace.php \" class=\"tlacitkopodmenu\"> Editovat záznam </a>
 <br />";
 if ($prefneslucitelnost!=''){
echo" <br /><a href=\"../neslucitelnost/tabulka_neslucitelnosti.php \" class=\"tlacitkopodmenu\" onclick=\"window.open(this.href,'_blank', 'width=600,height=400,menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\">Zobrazit tabulku nesluèitelnosti pøedmìtù</a><br />";

} 
echo" 
<br /><hr />
 ";
 require 'setup.php'; 
 
  echo"<div class=\"centrovano\"><!-- centrovano  -->    ";

  
  
  
 if ($zverejnit_pocty_prihlasenych) {
 
 $pro_predmety_pocty=new CRubrika_Bez_Foto($tabulka);
 $seznampr= $pro_predmety_pocty->VyberSeznamPredmetu();
 echo" <table  class=\"polozka\" width=\"90%\">
<tr><td> Obsazenost pøedmìtù </td></tr>
 ";
 for ($i=0;$i<count($seznampr[id]) ;$i++ ) {
 $osnovy_predmetu=$adresar_osnov.'/'.$seznampr[zkratka][$i].'.'.$pripona_osnov;
 if ( file_exists($osnovy_predmetu) ) {
 	$zobrazovany_nazev="<a href=\"$osnovy_predmetu\" class=\"tlacitkopodmenu\" onclick=\"window.open(this.href,'_blank', 'menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\">{$seznampr[predmet][$i]}</a>";
 }
 else {
$zobrazovany_nazev="<div class=\"tlacitkopodmenu\">{$seznampr[predmet][$i]}</div>"	;
 }
 $pocetprstud=$pro_predmety_pocty->PocetPrihlasenychPredmet($seznampr[predmet][$i]);
 if ((!strstr($seznampr[predmet][$i], '---'))&&(!strstr($seznampr[predmet][$i], 'žádný'))) {
 echo"<tr class=\"nadpisvpolozce \" ><td colspan=\"2\">$zobrazovany_nazev  {$seznampr[maxpocet][$i]} míst
 </td></tr>
 <tr><td class=\"textvpolozce \" >
     {$seznampr[zkratka][$i]}</td><td class=\"textvpolozce \" > obsazeno:{$pocetprstud[celkemprihlaseno]}";
if ($seznampr[maxpocet][$i]<$pocetprstud[celkemprihlaseno]) {
echo"<span class=\"chyba\"> pøekroèena kapacita</span> ";	     
}
     echo" </td>
  </tr>  ";	
 }


                                     }
 echo"</table>";	
 }
 
 else {
 	echo"

<br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<hr />
";
 }  
 


                                          
echo"
</div>                         <!-- centrovano   --> 



 


</div>  <!-- ppodmenu  --> 
     
     </div>  <!-- pravy sloupec uzky  --> 
 
 <div id=\"levy-sloupec-siroky\"> 

  ";

  ?> 

  

 
