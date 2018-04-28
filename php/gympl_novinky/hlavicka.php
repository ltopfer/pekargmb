<?php
$zobr=$_GET[zobr];$vyber=$zobr;
$co=$_GET[co];
$kategorie='gympl_novinky';$kategorie_nazav='Novinky';
require '../hlavicka.php';
require '../menu.php';
 require("cnovinky.php");
$pro_seznam_novinek=new CRubrika_Foto('gympl_novinky');
if ($co=='archiv') {
$seznam_novinek= $pro_seznam_novinek->VyberSeznamNovinekArchivovanych();
$filtrovanysloupec='archiv';$mahodnotu='ano'; $nazev_vyfiltrovane_polozky=' - archiv';	
}
else {
$seznam_novinek= $pro_seznam_novinek->VyberSeznamNovinekAktualnich();
	$filtrovanysloupec='archiv';$mahodnotu='ne'; $nazev_vyfiltrovane_polozky=' -&nbsp; aktuální';	
}

// echo"po4et";echo count($seznam_novinek[id]);
for ($i=0;$i<count($seznam_novinek[id]) && $i<20;$i++ ) { 
$polozka[$i]='gympl_novinky.php?zobr='.$seznam_novinek[id][$i].'&amp;co='.$co; 
$nazev[$i]=$seznam_novinek[nadpis][$i];
                                     }
 


     
 
 echo"

 <div id=\"pravy-sloupec-uzky\">
 <div class=\"podmenu\">
  <h2> $kategorie_nazav $nazev_vyfiltrovane_polozky</h2>
 <svg id=\"podmenuButton\" width=\"40\" height=\"30\" xmlns=\"http://www.w3.org/2000/svg\">
                            <line id=\"l1-podmenu\" stroke-linecap=\"square\" stroke-linejoin=\"undefined\" y2=\"8\" x2=\"5\" y1=\"18\" x1=\"19\" stroke-width=\"4\" stroke=\"#333333\" fill=\"none\"/>
                            <line id=\"l2-podmenu\" stroke-linecap=\"square\" stroke-linejoin=\"undefined\" y2=\"8\" x2=\"35\" y1=\"18\" x1=\"21\" stroke-width=\"4\" stroke=\"#333333\" fill=\"none\"/>
                        </svg> 
  
  
  ";
 if ($zobr=='') {
echo"
  <a href=\"gympl_novinky.php?co=$co \" class=\"tlacitkopodmenuakt\">Pøehled novinek</a>
     "; 	
 } 
 else {
  echo"
  <a href=\"gympl_novinky.php?co=$co \" class=\"tlacitkopodmenu\">Pøehled novinek</a>
     ";	
 } 
 
require '../vypis_podmenu.php';

if ($co!='archiv') {
echo" 
<a href=\"?co=archiv \" class=\"tlacitkopodmenuarchiv\"> Archiv novinek</a>";
}
else {
echo" 
<a href=\"?co= \" class=\"tlacitkopodmenuarchiv\"> Aktuální novinky</a>";	
}                                          
echo" 
<a href=\"../rss/rss_nanoivinky.php\" onclick=\"return !window.open(this.href)\" class=\"tlacitkopodmenurss\">RSS</a>
<br />
 <a href=\"administrace.php \" class=\"tlacitkopodmenu\"> Editace rubriky <br /> ( pro zamìstnance ) </a>
</div>  <!-- ppodmenu  --> 
     
     </div>  <!-- pravy sloupec uzky  --> 
 
 <div id=\"levy-sloupec-siroky\"> 

  ";

  ?> 

  

 
