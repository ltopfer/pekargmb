<?php
$kategorie='dokumentace';$kategorie_nazav='Dokumentace';
$ppmenu=$_GET[ppmenu];
require '../hlavicka.php';
require '../menu.php';
$polozka[]="skolni_rad.php";$nazev[]='�koln� ��d';$ppkat[]='';
$polozka[]="ucebni_plany.php";$nazev[]='U�ebn� pl�ny';$ppkat[]='';


$polozka[]="hodnoceni_jazyku.php";$nazev[]='Hodnocen� ciz�ch jazyk� dle
Spole�n�ho evropsk�ho referen�n�ho r�mce';$ppkat[]='';
//$polozka[]="studijni_literatura.php";$nazev[]='Studijn� literatura';$ppkat[]='';
$polozka[]="plan_ict.php";$nazev[]='ICT pl�n �koly';$ppkat[]='';
$polozka[]="platebni_kod.pdf";$nazev[]='Pravidla pro tvorbu platebn�ho k�du  (pdf)';$ppkat[]='';
$polozka[]="zadost_o_uvolneni.pdf";$nazev[]='��dost o uvoln�n� (pdf)';$ppkat[]='';
$polozka[]="uvolneni_z_vyuky.pdf";$nazev[]='��dost o uvoln�n� na v�ce dn� (pdf)';$ppkat[]='';
$polozka[]="uvolneni_tv.pdf";$nazev[]='��dost o uvoln�n� z hodin TV (pdf)';$ppkat[]='';
$polozka[]="druhopis.pdf";$nazev[]='��dost o vyd�n� druhopisu vysv�d�en� (pdf)';$ppkat[]='';
$polozka[]="vyrocni.pdf";$nazev[]='V�ro�n� zpr�va (*.pdf)';$ppkat[]='';


$polozka[]="plan_akci.php";$nazev[]='Pl�n akc�';$ppkat[]='';


     
 
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

  

 
