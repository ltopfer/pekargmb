<?php
$kategorie='verejnost';$kategorie_nazav='Pro ve�ejnost';
$ppmenu=$_GET[ppmenu];
require '../hlavicka.php';
require '../menu.php';

 $polozka[]='prijimacky.php';$nazev[]='P�ij�mac� zkou�ky';$ppkat[]='';

$polozka[]='co_nabizime.php';$nazev[]='Co nab�z�me';$ppkat[]='';
$polozka[]='studijni_smery.php';$nazev[]='Studijn� sm�ry';$ppkat[]='';
$k_pom='pprac';
$polozka[]="spp.php?ppmenu=$k_pom";$nazev[]='�koln� poradensk� pracovi�t�';$ppkat[]='';
if ($ppmenu==$k_pom) {
$polozka[]="../gympl_psycholog/gympl_psycholog.php?ppmenu=$k_pom";$nazev[]='�koln� psycholog';$ppkat[]=$k_pom;
$polozka[]="../gympl_poradce/gympl_poradce.php?ppmenu=$k_pom";$nazev[]='V�chovn� poradce';$ppkat[]=$k_pom;
$polozka[]="smp.php?ppmenu=$k_pom";$nazev[]='�koln� metodik prevence';$ppkat[]=$k_pom; 

}
 $polozka[]='inkluzivni_vzdelavani.php';$nazev[]='Inkluz�vn� vzd�l�v�n�';$ppkat[]=''; 
 $polozka[]='volna_mista.php';$nazev[]='Voln� pracovn� m�sta';$ppkat[]='';
$polozka[]='../projekty/podpora.php';$nazev[]='Podpora nab�dky dal��ho vzd�l�v�n� v oblasti IT ve vazb� na N�rodn� soustavu kvalifikaci';$ppkat[]='';
//$polozka[]='http://www.pekargmb.cz/aktualni_informace/mat_pl_1.php';$nazev[]='Maturitn� ples 2015-l�stky';$ppkat[]='';
$polozka[]='http://fialova.hostuju.cz';$nazev[]='P��pravn� kurzy ';$ppkat[]='';
$polozka[]='../gympl_casopis/gympl_casopis.php';$nazev[]='�koln� �asopis';$ppkat[]='';

$polozka[]="skolska_rada.php";$nazev[]='�kolsk� rada';$ppkat[]='';
 $polozka[]='nostrifikace.php';$nazev[]='Nostrifikace';$ppkat[]='';
$k_pom='por_org';
$polozka[]="?ppmenu=$k_pom#$k_pom";$nazev[]='Spole�nost p��tel <br /> Gymn�zia Dr. Josefa Peka�e';$ppkat[]='';

if ($ppmenu==$k_pom) {
$polozka[]="spravni_rada.php?ppmenu=$k_pom";$nazev[]='Spr�vn� rada';$ppkat[]=$k_pom;
$polozka[]="poradni_sbor.php?ppmenu=$k_pom";$nazev[]='Poradn� sbor Spr�vn� rady 
Spole�nosti p��tel GJP ';$ppkat[]=$k_pom;

}  
$polozka[]='gympl_nasinej.php';$nazev[]='Nejlep�� ��ci t��d za �k. rok 2016/2017';$ppkat[]='';
$polozka[]='gympl_absol.php';$nazev[]='V�znamn� absolventi';$ppkat[]='';
//$polozka[]='maturity_vyznamenani.pdf';$nazev[]='Maturity vyznamen�n� � 2011 ';$ppkat[]='';
$polozka[]='almanach.php';$nazev[]='Almanach mlad� tvorby';$ppkat[]='';$k_pom='vyb_zajezd';
//$polozka[]="?ppmenu=$k_pom#$k_pom";$nazev[]='V�b�rov� z�jezdy';$ppkat[]='';
/*if ($ppmenu==$k_pom) {
$polozka[]="vyb_zajezd.pdf?ppmenu=$k_pom";$nazev[]='V�b�rov� z�jezd 2010';$ppkat[]=$k_pom;


}  */

//$polozka[]='vyb_zajezd.pdf';$nazev[]='V�b�rov� z�jezd 2010';$ppkat[]='';
$polozka[]="../dokumentace/vyrocni.pdf";$nazev[]='V�ro�n� zpr�va (*.pdf)';$ppkat[]='';
//$polozka[]="../dokumentace/prijimacky_vs.pdf";$nazev[]='P�ij�mac� ��zen� na V� ';$ppkat[]='';
$polozka[]="office_skoleni.php";$nazev[]='Office �kolen� ';$ppkat[]='';
//$polozka[]='../gympl_fotogalerie/gympl_fotogalerie.php';$nazev[]='Fotogalerie';$ppkat[]='';

     
 
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

  

 
