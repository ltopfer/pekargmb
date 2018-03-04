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
  <h2>$kategorie_nazav</h2> 

 <a href=\"editace.php \" class=\"tlacitkopodmenu\"> Editovat záznam </a>";
 if ($prefneslucitelnost!=''){
echo "<a href=\"../neslucitelnost/tabulka_neslucitelnosti.php \" class=\"tlacitkopodmenu\" onclick=\"window.open(this.href,'_blank', 'width=600,height=400,menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\">Zobrazit tabulku nesluèitelnosti pøedmìtù</a>";

} 
echo" 
 ";
 

echo "
</div>  <!-- ppodmenu  --> 
     
     </div>  <!-- pravy sloupec uzky  --> 
 
 <div id=\"levy-sloupec-siroky\"> 

  ";

  ?> 

  

 
