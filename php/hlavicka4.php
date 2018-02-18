<?php
$kategorie='verejnost';$kategorie_nazav='Pro veøejnost';
$ppmenu=$_GET[ppmenu];
require '../hlavicka.php';
require '../menu.php';

 $polozka[]='prijimacky.php';$nazev[]='Pøijímací zkoušky';$ppkat[]='';

$polozka[]='co_nabizime.php';$nazev[]='Co nabízíme';$ppkat[]='';
$polozka[]='studijni_smery.php';$nazev[]='Studijní smìry';$ppkat[]='';
$k_pom='pprac';
$polozka[]="spp.php?ppmenu=$k_pom";$nazev[]='Školní poradenské pracovištì';$ppkat[]='';
if ($ppmenu==$k_pom) {
$polozka[]="../gympl_psycholog/gympl_psycholog.php?ppmenu=$k_pom";$nazev[]='Školní psycholog';$ppkat[]=$k_pom;
$polozka[]="../gympl_poradce/gympl_poradce.php?ppmenu=$k_pom";$nazev[]='Výchovný poradce';$ppkat[]=$k_pom;
$polozka[]="smp.php?ppmenu=$k_pom";$nazev[]='Školní metodik prevence';$ppkat[]=$k_pom; 

}
 $polozka[]='inkluzivni_vzdelavani.php';$nazev[]='Inkluzívní vzdìlávání';$ppkat[]=''; 
 $polozka[]='volna_mista.php';$nazev[]='Volná pracovní místa';$ppkat[]='';
$polozka[]='../projekty/podpora.php';$nazev[]='Podpora nabídky dalšího vzdìlávání v oblasti IT ve vazbì na Národní soustavu kvalifikaci';$ppkat[]='';
//$polozka[]='http://www.pekargmb.cz/aktualni_informace/mat_pl_1.php';$nazev[]='Maturitní ples 2015-lístky';$ppkat[]='';
$polozka[]='http://fialova.hostuju.cz';$nazev[]='Pøípravné kurzy ';$ppkat[]='';
$polozka[]='../gympl_casopis/gympl_casopis.php';$nazev[]='Školní èasopis';$ppkat[]='';

$polozka[]="skolska_rada.php";$nazev[]='Školská rada';$ppkat[]='';
 $polozka[]='nostrifikace.php';$nazev[]='Nostrifikace';$ppkat[]='';
$k_pom='por_org';
$polozka[]="?ppmenu=$k_pom#$k_pom";$nazev[]='Spoleènost pøátel <br /> Gymnázia Dr. Josefa Pekaøe';$ppkat[]='';

if ($ppmenu==$k_pom) {
$polozka[]="spravni_rada.php?ppmenu=$k_pom";$nazev[]='Správní rada';$ppkat[]=$k_pom;
$polozka[]="poradni_sbor.php?ppmenu=$k_pom";$nazev[]='Poradní sbor Správní rady 
Spoleènosti pøátel GJP ';$ppkat[]=$k_pom;

}  
$polozka[]='gympl_nasinej.php';$nazev[]='Nejlepší žáci tøíd za šk. rok 2016/2017';$ppkat[]='';
$polozka[]='gympl_absol.php';$nazev[]='Významní absolventi';$ppkat[]='';
//$polozka[]='maturity_vyznamenani.pdf';$nazev[]='Maturity vyznamenání – 2011 ';$ppkat[]='';
$polozka[]='almanach.php';$nazev[]='Almanach mladé tvorby';$ppkat[]='';$k_pom='vyb_zajezd';
//$polozka[]="?ppmenu=$k_pom#$k_pom";$nazev[]='Výbìrové zájezdy';$ppkat[]='';
/*if ($ppmenu==$k_pom) {
$polozka[]="vyb_zajezd.pdf?ppmenu=$k_pom";$nazev[]='Výbìrový zájezd 2010';$ppkat[]=$k_pom;


}  */

//$polozka[]='vyb_zajezd.pdf';$nazev[]='Výbìrový zájezd 2010';$ppkat[]='';
$polozka[]="../dokumentace/vyrocni.pdf";$nazev[]='Výroèní zpráva (*.pdf)';$ppkat[]='';
//$polozka[]="../dokumentace/prijimacky_vs.pdf";$nazev[]='Pøijímací øízení na VŠ ';$ppkat[]='';
$polozka[]="office_skoleni.php";$nazev[]='Office školení ';$ppkat[]='';
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

  

 
