<?php
$kategorie='projekty';$kategorie_nazav='Projekty';
require '../hlavicka.php';
require '../menu.php';
$polozka[]='podpora.php';$nazev[]='Podpora nabídky dalšího vzdìlávání v oblasti IT ve vazbì na Národní soustavu kvalifikaci';
$polozka[]='budoucnost.php';$nazev[]='Dotknìme se budoucnosti';
$polozka[]='hra.php';$nazev[]='Investování hrou';
$polozka[]='ucitel_on_line.php';$nazev[]='Uèitel online';
$polozka[]='pekar_edu.php';$nazev[]='Projekt PekarEdu';
$polozka[]='pekar_56.php';$nazev[]='Pekar 56';
$polozka[]='pekar_57.php';$nazev[]='Pekar 57';
$polozka[]='pekar_skolni_hriste.php';$nazev[]='Pekar – školní høištì pro veøejnost';
$polozka[]='dalsi_vzdelavani.php';$nazev[]='Další vzdìlávání pedagogických pracovníkù Gymnázia Dr. Josefa Pekaøe, Mladá Boleslav';

$polozka[]='male_granty.php';$nazev[]='Malé granty';
$polozka[]='modernizace.php';$nazev[]='Modernizace škol zøizovaných Støedoèeským krajem';
$polozka[]='moderni_dejiny.pdf';$nazev[]='Moderní dìjiny trochu jinak';
$polozka[]='partnerstvi_ve_vzdelavani.php';$nazev[]='Partnerství ve vzdìlávání ';
$polozka[]='zelena_skola.php';$nazev[]='Zelená škola';
$polozka[]='deti_mensa.php';$nazev[]='Dìtská Mensa';
$polozka[]='emil.php';$nazev[]='Emil';
//$polozka[]='did.pdf';$nazev[]='Projekt – DELIBERATING IN A DEMOCRACY';     
$polozka[]='krasna_je_boleslav.pdf';$nazev[]='Krásná je Boleslav';
$polozka[]='citizens.php';$nazev[]='ACTIVE CITIZENS';
$polozka[]='partnerske_skoly.pdf';$nazev[]='Partnerské školy';
$polozka[]='nasi_partneri.php';$nazev[]='Naši partneøi';  
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

  

 
