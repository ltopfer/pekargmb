<?php
$kategorie='proucitele';$kategorie_nazav='Pro uèitele';
$ppmenu=$_GET[ppmenu];
require '../hlavicka.php';
require '../menu.php';
$polozka[]="plan_akci.php";$nazev[]='Plán akcí';$ppkat[]='';
$polozka[]="ucebni_plany.php";$nazev[]='Uèební plány';$ppkat[]='';
$polozka[]='../gympl_casopis/gympl_casopis.php';$nazev[]='Školní èasopis';$ppkat[]='';
$polozka[]='https://mail.pekargmb.cz/bakaweb';$nazev[]=' Webové aplikace-vstup';$ppkat[]='';

$polozka[]='https://login.microsoftonline.com/';$nazev[]='Email pro zamìstnance';$ppkat[]='';
$k_pom='rozvrhy';
$polozka[]="rozvrhy.php?ppmenu=$k_pom&zobr=tridy#$k_pom";$nazev[]='Rozvrhy';$ppkat[]='';
/*if ($ppmenu==$k_pom) {
$polozka[]="../rozvrh/rozvrhtr.htm?ppmenu=$k_pom";$nazev[]='Rozvrh (tøídy)';$ppkat[]=$k_pom;
$polozka[]="../rozvrh/rozvrhuc.htm?ppmenu=$k_pom";$nazev[]='Rozvrh (uèitelé)';$ppkat[]=$k_pom;
$polozka[]="http://supl.esy.es/supl/suplovtr.htm?ppmenu=$k_pom";$nazev[]='Suplování (tøídy)';$ppkat[]=$k_pom;	
}*/
if ($ppmenu==$k_pom) {
    $polozka[]="rozvrhy.php?ppmenu=$k_pom&zobr=tridy";$nazev[]='Rozvrh (tøídy)';$ppkat[]=$k_pom;
    $polozka[]="rozvrhy.php?ppmenu=$k_pom&zobr=ucitele";$nazev[]='Rozvrh (uèitelé)';$ppkat[]=$k_pom;
    $polozka[]="rozvrhy.php?ppmenu=$k_pom&zobr=supl";$nazev[]='Suplování (tøídy)';$ppkat[]=$k_pom;	
}

/*$k_pom='jidelna';
$polozka[]="?ppmenu=$k_pom#$k_pom";$nazev[]='Školní jídelna';$ppkat[]='';
if ($ppmenu==$k_pom) {

$polozka[]="../organizace_studia/jidelnicek.pdf?ppmenu=$k_pom";$nazev[]='Jídelníèek';$ppkat[]=$k_pom;
$polozka[]="../organizace_studia/jidelnicek1.pdf?ppmenu=$k_pom";$nazev[]='Jídelníèek další týden';$ppkat[]=$k_pom;

}*/
$k_pom='jidelna';   
$polozka[]="jidelna.php?ppmenu=$k_pom#$k_pom";$nazev[]='Školní jídelna';$ppkat[]='';
if ($ppmenu==$k_pom) {
    $polozka[]="jidelna.php?ppmenu=$k_pom";$nazev[]='Školní jídelna';$ppkat[]=$k_pom;
    $polozka[]="odhlasky.php?ppmenu=$k_pom";$nazev[]='Odhlášky obìdù';$ppkat[]=$k_pom;

    $polozka[]="jidelnicek.pdf?ppmenu=$k_pom";$nazev[]='Jídelníèek';$ppkat[]=$k_pom;
    $polozka[]="jidelnicek1.pdf?ppmenu=$k_pom";$nazev[]='Jídelníèek další týden';$ppkat[]=$k_pom;
    $polozka[]="http://www.strava.cz?ppmenu=$k_pom";$nazev[]='Objednávání stravy';$ppkat[]=$k_pom;
    $polozka[]="prihlaska_stravovani.pdf?ppmenu=$k_pom";$nazev[]='Pøihláška ke stravování';$ppkat[]=$k_pom;
    $polozka[]="strav_komise.pdf?ppmenu=$k_pom";$nazev[]='Stravovací komise';$ppkat[]=$k_pom;
}

$polozka[]="http://www.pekargmb.cz/vol_rezervace/vlozenirezervaci/editace_ddd.php";$nazev[]='Rezervace';$ppkat[]='';


     
 
 echo"

 <div id=\"pravy-sloupec-uzky\">
 <div class=\"podmenu\">
 <h2> $kategorie_nazav </h2>
   <svg id=\"podmenuButton\" width=\"40\" height=\"30\" xmlns=\"http://www.w3.org/2000/svg\">
                            <line id=\"l1-podmenu\" stroke-linecap=\"square\" stroke-linejoin=\"undefined\" y2=\"8\" x2=\"5\" y1=\"18\" x1=\"19\" stroke-width=\"4\" stroke=\"#333333\" fill=\"none\"/>
                            <line id=\"l2-podmenu\" stroke-linecap=\"square\" stroke-linejoin=\"undefined\" y2=\"8\" x2=\"35\" y1=\"18\" x1=\"21\" stroke-width=\"4\" stroke=\"#333333\" fill=\"none\"/>
                        </svg>  
     ";
     
require '../vypis_podmenu.php';
echo" </div>  <!-- ppodmenu  --> 

     </div>  <!-- pravy sloupec uzky  --> 
 
 <div id=\"levy-sloupec-siroky\"> 
  ";

  ?> 

  

 
