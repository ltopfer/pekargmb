<?php
$kategorie='organizace_studia';$kategorie_nazav='Pro studenty';
$ppmenu=$_GET[ppmenu];
require '../hlavicka.php';
require '../menu.php';


$polozka[]='skolni_rad.php';$nazev[]='Školní øád';$ppkat[]='';
//$polozka[]='http://www.pekargmb.cz/aktualni_informace/mat_pl_1.php';$nazev[]='Maturitní ples 2014-lístky';$ppkat[]='';
$polozka[]='../gympl_psycholog/gympl_psycholog.php';$nazev[]='Školní psycholog';$ppkat[]='';
$polozka[]='http://www.schranka-duvery.cz/9667231f';$nazev[]='Schránka dùvìry';$ppkat[]='';
$polozka[]='../gympl_poradce/gympl_poradce.php';$nazev[]='Výchovný poradce';$ppkat[]='';
$polozka[]='http://fialova.hostuju.cz';$nazev[]=' Pøípravné kurzy';$ppkat[]='';
$polozka[]='https://mail.pekargmb.cz/bakaweb';$nazev[]=' Webové aplikace-vstup';$ppkat[]='';
$polozka[]='elearning.php';$nazev[]='Stránky komisí (Elearning)';$ppkat[]=''; 
$polozka[]='http://parlament.pekcloud.cz/';$nazev[]='Studentský parlament';$ppkat[]='';

$polozka[]='http://www.pekcloud.cz';$nazev[]='Pek Cloud';$ppkat[]='';
$polozka[]='wifi.php';$nazev[]='WiFi sí';$ppkat[]='';
$polozka[]='vs.php';$nazev[]='Vysoké školy';$ppkat[]='';
$polozka[]='../gympl_casopis/gympl_casopis.php';$nazev[]='Školní èasopis';$ppkat[]='';

$polozka[]='http://www.pekargmb.cz/vol_primajaz/svp/editace.php';$nazev[]='Prima volba jazykù';$ppkat[]='';  
$polozka[]='http://www.pekargmb.cz/vol_pr1rocjaz/svp/editace.php';$nazev[]='1.roè. volba jazykù';$ppkat[]='';
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

  

$k_pom='maturita';
$polozka[]="maturita_2017_18.php?ppmenu=$k_pom#$k_pom";$nazev[]='Maturita';$ppkat[]='';
if ($ppmenu==$k_pom) {
$polozka[]="maturita_2017_18.php?ppmenu=$k_pom";$nazev[]='Maturita 2017/2018';$ppkat[]=$k_pom;

$polozka[]="maturitni_otazky.php?ppmenu=$k_pom";$nazev[]='Maturitní otázky 2017/2018 –&nbsp;profilová èást';$ppkat[]=$k_pom;

}

//$polozka[]='maturita_2010_11.php';$nazev[]='Maturita 2010/2011';$ppkat[]='';
$k_pom='vol_pr';
$polozka[]="volitelne_predmety.php?ppmenu=$k_pom#$k_pom";$nazev[]='Volitelné pøedmìty';$ppkat[]='';
if ($ppmenu==$k_pom) {
$polozka[]="nab_vol_pr_17_18.pdf?ppmenu=$k_pom";$nazev[]='Nabízené volitelné pøedmìty 2017/2018';$ppkat[]=$k_pom;
//$polozka[]="vol_pr_15_16.pdf?ppmenu=$k_pom";$nazev[]='Volitelné pøedmìty 2015/16 (podmínky výbìru)';$ppkat[]=$k_pom;
$polozka[]="osnovy_nab_vol_pr__2017_18.php?ppmenu=$k_pom";$nazev[]='Osnovy nabízených volitelných pøedmìtù 2017/18';$ppkat[]=$k_pom;
$polozka[]="vol_pr_2016_17.pdf?ppmenu=$k_pom";$nazev[]='Volitelné pøedmìty 2016/17';$ppkat[]=$k_pom;
$polozka[]="osnovy_otevrenych_vol_pr__2016_17.php?ppmenu=$k_pom";$nazev[]='Osnovy otevøených volitelných pøedmìtù ve školním roce 2016/2017';$ppkat[]=$k_pom;
$polozka[]="prezentace_k_v_p.php?ppmenu=$k_pom";$nazev[]='Prezentace k volitelným pøedmìtùm';$ppkat[]=$k_pom; 
//$polozka[]="podminky_v_p.pdf?ppmenu=$k_pom";$nazev[]='Podmínky volby VP';$ppkat[]=$k_pom;
$polozka[]="../vol_pr3roc/svp/editace.php?ppmenu=$k_pom";$nazev[]='RPS do 3. a 4.roèníku (dvouleté pø.)';$ppkat[]=$k_pom;
$polozka[]="../vol_pr3jednolroc/svp/editace.php?ppmenu=$k_pom";$nazev[]='RPS do  3.roèníku  <br />(jednoleté pø.)';$ppkat[]=$k_pom;
$polozka[]="../vol_pr4jednolroc/svp/editace.php?ppmenu=$k_pom";$nazev[]='RPS do  4.roèníku <br /> (jednoleté pø.)';$ppkat[]=$k_pom; 
}

//$polozka[]="tridni.php";$nazev[]='Tøídní uèitelé a jejich zástupci';$ppkat[]='';

$k_pom='zadosti';
$polozka[]="?ppmenu=$k_pom#$k_pom";$nazev[]='Žádosti';$ppkat[]='';
if ($ppmenu==$k_pom) {
$polozka[]="../dokumentace/zadost_o_uvolneni.pdf?ppmenu=$k_pom";$nazev[]='Žádost o uvolnìní (pdf)';$ppkat[]=$k_pom;
$polozka[]="../dokumentace/uvolneni_z_vyuky.pdf?ppmenu=$k_pom";$nazev[]='Žádost o uvolnìní na více dní (pdf)';$ppkat[]=$k_pom;
$polozka[]="../dokumentace/uvolneni_tv.pdf?ppmenu=$k_pom";$nazev[]='Žádost o uvolnìní z hodin TV (pdf)';$ppkat[]=$k_pom;
$polozka[]="../dokumentace/druhopis.pdf?ppmenu=$k_pom";$nazev[]='Žádost o vydání druhopisu vysvìdèení (pdf)';$ppkat[]=$k_pom;
$polozka[]="../dokumentace/zadost_odchod_a_prichod.pdf?ppmenu=$k_pom";$nazev[]='Souhlas s pøedèasným odchodem ze školní akce a
souhlas s pozdìjším pøipojením ke školní akci  (pdf)';$ppkat[]=$k_pom;

}
$polozka[]="kopirovani.php";$nazev[]='Kopírování na studentské karty ISIC';$ppkat[]='';
$polozka[]="../verejnost/office_skoleni.php";$nazev[]='Office školení ';$ppkat[]='';
$polozka[]="../dokumentace/platebni_kod.pdf";$nazev[]='Pravidla pro tvorbu platebního kódu (pdf)';$ppkat[]='';


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
//$polozka[]="http://www.pekargmb.cz/gympl_novinky/gympl_novinky.php?zobr=1467?ppmenu=$k_pom";$nazev[]='Školní jídelna - odhlášení obìdù';$ppkat[]=$k_pom;

//$polozka[]="http://www.pekargmb.cz/gympl_novinky/gympl_novinky.php?zobr=1418?ppmenu=$k_pom";$nazev[]='Pøihlašování a odhlašování stravy pomocí mobilní aplikace';$ppkat[]=$k_pom;

 //$polozka[]="jideln_prihlasky_apl.php?ppmenu=$k_pom";$nazev[]='Pøihlašování a odhlašování stravy pomocí mobilní aplikace';$ppkat[]=$k_pom;

}


     
 
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

  

 
