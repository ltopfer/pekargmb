<?php
$kategorie='dokumentace';$kategorie_nazav='Dokumentace';
$ppmenu=$_GET[ppmenu];
require '../hlavicka.php';
require '../menu.php';
$polozka[]="skolni_rad.php";$nazev[]='Školní øád';$ppkat[]='';
$polozka[]="ucebni_plany.php";$nazev[]='Uèební plány';$ppkat[]='';


$polozka[]="hodnoceni_jazyku.php";$nazev[]='Hodnocení cizích jazykù dle
Spoleèného evropského referenèního rámce';$ppkat[]='';
//$polozka[]="studijni_literatura.php";$nazev[]='Studijní literatura';$ppkat[]='';
$polozka[]="plan_ict.php";$nazev[]='ICT plán školy';$ppkat[]='';
$polozka[]="platebni_kod.pdf";$nazev[]='Pravidla pro tvorbu platebního kódu  (pdf)';$ppkat[]='';
$polozka[]="zadost_o_uvolneni.pdf";$nazev[]='Žádost o uvolnìní (pdf)';$ppkat[]='';
$polozka[]="uvolneni_z_vyuky.pdf";$nazev[]='Žádost o uvolnìní na více dní (pdf)';$ppkat[]='';
$polozka[]="uvolneni_tv.pdf";$nazev[]='Žádost o uvolnìní z hodin TV (pdf)';$ppkat[]='';
$polozka[]="druhopis.pdf";$nazev[]='Žádost o vydání druhopisu vysvìdèení (pdf)';$ppkat[]='';
$polozka[]="vyrocni.pdf";$nazev[]='Výroèní zpráva (*.pdf)';$ppkat[]='';


$polozka[]="plan_akci.php";$nazev[]='Plán akcí';$ppkat[]='';


     
 
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

  

 
