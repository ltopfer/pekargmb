<?php
$kategorie='projekty';$kategorie_nazav='Projekty';
require '../hlavicka.php';
require '../menu.php';
$polozka[]='podpora.php';$nazev[]='Podpora nab�dky dal��ho vzd�l�v�n� v oblasti IT ve vazb� na N�rodn� soustavu kvalifikaci';
$polozka[]='budoucnost.php';$nazev[]='Dotkn�me se budoucnosti';
$polozka[]='hra.php';$nazev[]='Investov�n� hrou';
$polozka[]='ucitel_on_line.php';$nazev[]='U�itel online';
$polozka[]='pekar_edu.php';$nazev[]='Projekt PekarEdu';
$polozka[]='pekar_56.php';$nazev[]='Pekar 56';
$polozka[]='pekar_57.php';$nazev[]='Pekar 57';
$polozka[]='pekar_skolni_hriste.php';$nazev[]='Pekar � �koln� h�i�t� pro ve�ejnost';
$polozka[]='dalsi_vzdelavani.php';$nazev[]='Dal�� vzd�l�v�n� pedagogick�ch pracovn�k� Gymn�zia Dr. Josefa Peka�e, Mlad� Boleslav';

$polozka[]='male_granty.php';$nazev[]='Mal� granty';
$polozka[]='modernizace.php';$nazev[]='Modernizace �kol z�izovan�ch St�edo�esk�m krajem';
$polozka[]='moderni_dejiny.pdf';$nazev[]='Modern� d�jiny trochu jinak';
$polozka[]='partnerstvi_ve_vzdelavani.php';$nazev[]='Partnerstv� ve vzd�l�v�n� ';
$polozka[]='zelena_skola.php';$nazev[]='Zelen� �kola';
$polozka[]='deti_mensa.php';$nazev[]='D�tsk� Mensa';
$polozka[]='emil.php';$nazev[]='Emil';
//$polozka[]='did.pdf';$nazev[]='Projekt � DELIBERATING IN A DEMOCRACY';     
$polozka[]='krasna_je_boleslav.pdf';$nazev[]='Kr�sn� je Boleslav';
$polozka[]='citizens.php';$nazev[]='ACTIVE CITIZENS';
$polozka[]='partnerske_skoly.pdf';$nazev[]='Partnersk� �koly';
$polozka[]='nasi_partneri.php';$nazev[]='Na�i partne�i';  
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

  

 
