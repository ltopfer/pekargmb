<?php
$kategorie='organizace_studia';$kategorie_nazav='Pro studenty';
$ppmenu=$_GET[ppmenu];
require '../hlavicka.php';
require '../menu.php';


$polozka[]='skolni_rad.php';$nazev[]='�koln� ��d';$ppkat[]='';
//$polozka[]='http://www.pekargmb.cz/aktualni_informace/mat_pl_1.php';$nazev[]='Maturitn� ples 2014-l�stky';$ppkat[]='';
$polozka[]='../gympl_psycholog/gympl_psycholog.php';$nazev[]='�koln� psycholog';$ppkat[]='';
$polozka[]='http://www.schranka-duvery.cz/9667231f';$nazev[]='Schr�nka d�v�ry';$ppkat[]='';
$polozka[]='../gympl_poradce/gympl_poradce.php';$nazev[]='V�chovn� poradce';$ppkat[]='';
$polozka[]='http://fialova.hostuju.cz';$nazev[]=' P��pravn� kurzy';$ppkat[]='';
$polozka[]='https://mail.pekargmb.cz/bakaweb';$nazev[]=' Webov� aplikace-vstup';$ppkat[]='';
$polozka[]='elearning.php';$nazev[]='Str�nky komis� (Elearning)';$ppkat[]=''; 
$polozka[]='http://parlament.pekcloud.cz/';$nazev[]='Studentsk� parlament';$ppkat[]='';

$polozka[]='http://www.pekcloud.cz';$nazev[]='Pek Cloud';$ppkat[]='';
$polozka[]='wifi.php';$nazev[]='WiFi s�';$ppkat[]='';
$polozka[]='vs.php';$nazev[]='Vysok� �koly';$ppkat[]='';
$polozka[]='../gympl_casopis/gympl_casopis.php';$nazev[]='�koln� �asopis';$ppkat[]='';

$polozka[]='http://www.pekargmb.cz/vol_primajaz/svp/editace.php';$nazev[]='Prima volba jazyk�';$ppkat[]='';  
$polozka[]='http://www.pekargmb.cz/vol_pr1rocjaz/svp/editace.php';$nazev[]='1.ro�. volba jazyk�';$ppkat[]='';
$k_pom='rozvrhy';
$polozka[]="rozvrhy.php?ppmenu=$k_pom&zobr=tridy#$k_pom";$nazev[]='Rozvrhy';$ppkat[]='';
/*if ($ppmenu==$k_pom) {
$polozka[]="../rozvrh/rozvrhtr.htm?ppmenu=$k_pom";$nazev[]='Rozvrh (t��dy)';$ppkat[]=$k_pom;
$polozka[]="../rozvrh/rozvrhuc.htm?ppmenu=$k_pom";$nazev[]='Rozvrh (u�itel�)';$ppkat[]=$k_pom;
$polozka[]="http://supl.esy.es/supl/suplovtr.htm?ppmenu=$k_pom";$nazev[]='Suplov�n� (t��dy)';$ppkat[]=$k_pom;	
}*/
if ($ppmenu==$k_pom) {
    $polozka[]="rozvrhy.php?ppmenu=$k_pom&zobr=tridy";$nazev[]='Rozvrh (t��dy)';$ppkat[]=$k_pom;
    $polozka[]="rozvrhy.php?ppmenu=$k_pom&zobr=ucitele";$nazev[]='Rozvrh (u�itel�)';$ppkat[]=$k_pom;
    $polozka[]="rozvrhy.php?ppmenu=$k_pom&zobr=supl";$nazev[]='Suplov�n� (t��dy)';$ppkat[]=$k_pom;	
}

  

$k_pom='maturita';
$polozka[]="maturita_2017_18.php?ppmenu=$k_pom#$k_pom";$nazev[]='Maturita';$ppkat[]='';
if ($ppmenu==$k_pom) {
$polozka[]="maturita_2017_18.php?ppmenu=$k_pom";$nazev[]='Maturita 2017/2018';$ppkat[]=$k_pom;

$polozka[]="maturitni_otazky.php?ppmenu=$k_pom";$nazev[]='Maturitn� ot�zky 2017/2018 �&nbsp;profilov� ��st';$ppkat[]=$k_pom;

}

//$polozka[]='maturita_2010_11.php';$nazev[]='Maturita 2010/2011';$ppkat[]='';
$k_pom='vol_pr';
$polozka[]="volitelne_predmety.php?ppmenu=$k_pom#$k_pom";$nazev[]='Voliteln� p�edm�ty';$ppkat[]='';
if ($ppmenu==$k_pom) {
$polozka[]="nab_vol_pr_17_18.pdf?ppmenu=$k_pom";$nazev[]='Nab�zen� voliteln� p�edm�ty 2017/2018';$ppkat[]=$k_pom;
//$polozka[]="vol_pr_15_16.pdf?ppmenu=$k_pom";$nazev[]='Voliteln� p�edm�ty 2015/16 (podm�nky v�b�ru)';$ppkat[]=$k_pom;
$polozka[]="osnovy_nab_vol_pr__2017_18.php?ppmenu=$k_pom";$nazev[]='Osnovy nab�zen�ch voliteln�ch p�edm�t� 2017/18';$ppkat[]=$k_pom;
$polozka[]="vol_pr_2016_17.pdf?ppmenu=$k_pom";$nazev[]='Voliteln� p�edm�ty 2016/17';$ppkat[]=$k_pom;
$polozka[]="osnovy_otevrenych_vol_pr__2016_17.php?ppmenu=$k_pom";$nazev[]='Osnovy otev�en�ch voliteln�ch p�edm�t� ve �koln�m roce 2016/2017';$ppkat[]=$k_pom;
$polozka[]="prezentace_k_v_p.php?ppmenu=$k_pom";$nazev[]='Prezentace k voliteln�m p�edm�t�m';$ppkat[]=$k_pom; 
//$polozka[]="podminky_v_p.pdf?ppmenu=$k_pom";$nazev[]='Podm�nky volby VP';$ppkat[]=$k_pom;
$polozka[]="../vol_pr3roc/svp/editace.php?ppmenu=$k_pom";$nazev[]='RPS do 3. a 4.ro�n�ku (dvoulet� p�.)';$ppkat[]=$k_pom;
$polozka[]="../vol_pr3jednolroc/svp/editace.php?ppmenu=$k_pom";$nazev[]='RPS do  3.ro�n�ku  <br />(jednolet� p�.)';$ppkat[]=$k_pom;
$polozka[]="../vol_pr4jednolroc/svp/editace.php?ppmenu=$k_pom";$nazev[]='RPS do  4.ro�n�ku <br /> (jednolet� p�.)';$ppkat[]=$k_pom; 
}

//$polozka[]="tridni.php";$nazev[]='T��dn� u�itel� a jejich z�stupci';$ppkat[]='';

$k_pom='zadosti';
$polozka[]="?ppmenu=$k_pom#$k_pom";$nazev[]='��dosti';$ppkat[]='';
if ($ppmenu==$k_pom) {
$polozka[]="../dokumentace/zadost_o_uvolneni.pdf?ppmenu=$k_pom";$nazev[]='��dost o uvoln�n� (pdf)';$ppkat[]=$k_pom;
$polozka[]="../dokumentace/uvolneni_z_vyuky.pdf?ppmenu=$k_pom";$nazev[]='��dost o uvoln�n� na v�ce dn� (pdf)';$ppkat[]=$k_pom;
$polozka[]="../dokumentace/uvolneni_tv.pdf?ppmenu=$k_pom";$nazev[]='��dost o uvoln�n� z hodin TV (pdf)';$ppkat[]=$k_pom;
$polozka[]="../dokumentace/druhopis.pdf?ppmenu=$k_pom";$nazev[]='��dost o vyd�n� druhopisu vysv�d�en� (pdf)';$ppkat[]=$k_pom;
$polozka[]="../dokumentace/zadost_odchod_a_prichod.pdf?ppmenu=$k_pom";$nazev[]='Souhlas s p�ed�asn�m odchodem ze �koln� akce a
souhlas s pozd�j��m p�ipojen�m ke �koln� akci  (pdf)';$ppkat[]=$k_pom;

}
$polozka[]="kopirovani.php";$nazev[]='Kop�rov�n� na studentsk� karty ISIC';$ppkat[]='';
$polozka[]="../verejnost/office_skoleni.php";$nazev[]='Office �kolen� ';$ppkat[]='';
$polozka[]="../dokumentace/platebni_kod.pdf";$nazev[]='Pravidla pro tvorbu platebn�ho k�du (pdf)';$ppkat[]='';


$k_pom='jidelna';
$polozka[]="jidelna.php?ppmenu=$k_pom#$k_pom";$nazev[]='�koln� j�delna';$ppkat[]='';
if ($ppmenu==$k_pom) {
$polozka[]="jidelna.php?ppmenu=$k_pom";$nazev[]='�koln� j�delna';$ppkat[]=$k_pom;
$polozka[]="odhlasky.php?ppmenu=$k_pom";$nazev[]='Odhl�ky ob�d�';$ppkat[]=$k_pom;

$polozka[]="jidelnicek.pdf?ppmenu=$k_pom";$nazev[]='J�deln��ek';$ppkat[]=$k_pom;
$polozka[]="jidelnicek1.pdf?ppmenu=$k_pom";$nazev[]='J�deln��ek dal�� t�den';$ppkat[]=$k_pom;
$polozka[]="http://www.strava.cz?ppmenu=$k_pom";$nazev[]='Objedn�v�n� stravy';$ppkat[]=$k_pom;
$polozka[]="prihlaska_stravovani.pdf?ppmenu=$k_pom";$nazev[]='P�ihl�ka ke stravov�n�';$ppkat[]=$k_pom;
$polozka[]="strav_komise.pdf?ppmenu=$k_pom";$nazev[]='Stravovac� komise';$ppkat[]=$k_pom;
//$polozka[]="http://www.pekargmb.cz/gympl_novinky/gympl_novinky.php?zobr=1467?ppmenu=$k_pom";$nazev[]='�koln� j�delna - odhl�en� ob�d�';$ppkat[]=$k_pom;

//$polozka[]="http://www.pekargmb.cz/gympl_novinky/gympl_novinky.php?zobr=1418?ppmenu=$k_pom";$nazev[]='P�ihla�ov�n� a odhla�ov�n� stravy pomoc� mobiln� aplikace';$ppkat[]=$k_pom;

 //$polozka[]="jideln_prihlasky_apl.php?ppmenu=$k_pom";$nazev[]='P�ihla�ov�n� a odhla�ov�n� stravy pomoc� mobiln� aplikace';$ppkat[]=$k_pom;

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

  

 
