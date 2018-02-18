<?php
$prohlizeno=$_GET[prohlizeno];
$hledani=$_POST[hledani];
if ($hledani=='vyhledat') {
$sloup=$_POST[sloup];
$hodnotasloup=$_POST[$sloup];
$sloupec=$sloup;$hodnotasloupce=ucfirst(strtolower($hodnotasloup));
}
else {$sloupec=$_GET[sloupec];$hodnotasloupce=$_GET[hodnotasloupce];}
$zobr=$_GET[zobr];$vyber=$zobr;
$kategorie='gympl_ucitele';$kategorie_nazav='Kontakty';
require '../hlavicka.php';
require '../menu.php';
 require("cucitele.php");   
 $pro_seznam_ucitelu=new CRubrika_Foto('gympl_ucitele');
 $seznam_uzivatelu= $pro_seznam_ucitelu->VyberSeznamUzivatelu();
// echo"po4et";echo count($seznam_novinek[id]);
for ($i=0;$i<count($seznam_uzivatelu[id]) ;$i++ ) { 
$polozka[$i]='gympl_ucitele.php?zobr='.$seznam_uzivatelu[id][$i]; 
$nazev[$i]=$seznam_uzivatelu[prijmeni][$i].' '.$seznam_uzivatelu[jmeno][$i].'  '.$seznam_uzivatelu[titul][$i];
                                   } 
 echo"
<script src=\"hlidac.js\" type=\"text/javascript\"></script> 
 <div id=\"pravy-sloupec-uzky\">
 <div class=\"podmenu\">
 <h2> $kategorie_nazav </h2>
   <svg id=\"podmenuButton\" width=\"40\" height=\"30\" xmlns=\"http://www.w3.org/2000/svg\">
                            <line id=\"l1-podmenu\" stroke-linecap=\"square\" stroke-linejoin=\"undefined\" y2=\"8\" x2=\"5\" y1=\"18\" x1=\"19\" stroke-width=\"4\" stroke=\"#333333\" fill=\"none\"/>
                            <line id=\"l2-podmenu\" stroke-linecap=\"square\" stroke-linejoin=\"undefined\" y2=\"8\" x2=\"35\" y1=\"18\" x1=\"21\" stroke-width=\"4\" stroke=\"#333333\" fill=\"none\"/>
                        </svg>  
 ";
 if ($prohlizeno=='telefon') {
 	echo"<a href=\"telefon.php?prohlizeno=telefon \" class=\"tlacitkopodmenuakt\">Telefonní linky</a>";
 }
else {
	echo"<a href=\"telefon.php?prohlizeno=telefon \" class=\"tlacitkopodmenu\">Telefonní linky</a>";	
}
 if ($prohlizeno=='mapa') {
 	echo"<a href=\"mapa.php?prohlizeno=mapa \" class=\"tlacitkopodmenuakt\">Poloha školy na mapì</a>";
 }
else {
	echo"<a href=\"mapa.php?prohlizeno=mapa \" class=\"tlacitkopodmenu\">Poloha školy na mapì</a>";	
}

echo"
 <br />
<a href=\"../gympl_psycholog/gympl_psycholog.php \" class=\"tlacitkopodmenu\">Školní psycholog</a>
<a href=\"../gympl_poradce/gympl_poradce.php \" class=\"tlacitkopodmenu\">Výchovný poradce</a>  
  ";
     
  
  echo"
  <h5> Kategorie zamìstnancù </h5>
  ";
if ($hodnotasloupce=='uèitelé') {
echo"
  <a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=uèitelé  \" class=\"tlacitkopodmenuakt\"> Uèitelé</a>";	
} 
else {
echo"
  <a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=uèitelé  \" class=\"tlacitkopodmenu\"> Uèitelé</a>";	
} 
if ($hodnotasloupce=='thp pracovníci') {
 echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=thp pracovníci \" class=\"tlacitkopodmenuakt\"> THP pracovníci</a>";
  }
else {
 echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=thp pracovníci \" class=\"tlacitkopodmenu\"> THP pracovníci</a>";	
} 

if ($hodnotasloupce=='správní zamìstnanci') {
echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=správní zamìstnanci \" class=\"tlacitkopodmenuakt\"> Správní zamìstnaneci</a>";	
}
else {
echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=správní zamìstnanci \" class=\"tlacitkopodmenu\"> Správní zamìstnaneci</a>";	
}
if ($hodnotasloupce=='hala') {
echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=hala \" class=\"tlacitkopodmenuakt\"> Hala</a>";	
}
else {
	echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=hala \" class=\"tlacitkopodmenu\"> Hala</a>";
}
if ($hodnotasloupce=='jídelna') {
echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=jídelna \" class=\"tlacitkopodmenuakt\"> Jídelna</a>";	
}
else {
echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=jídelna \" class=\"tlacitkopodmenu\"> Jídelna</a>";	
}
if ($prohlizeno=='celyseznam') {
echo"
   <a href=\"gympl_ucitele.php?prohlizeno=celyseznam&amp;zobr= \" class=\"tlacitkopodmenuakt\">Seznam všech zamìstnancù </a> 
  
  ";	
}
else {
echo"
   <a href=\"gympl_ucitele.php?prohlizeno=celyseznam&amp;zobr= \" class=\"tlacitkopodmenu\">Seznam všech zamìstnancù </a> 
  
  ";	
}

  
  echo"
   <br />
   <h5> Zamìstnanci školy </h5>  
     ";
 $pro_seznam_ucitelu->Formular_hledej('gympl_ucitele.php','prijmeni');    
echo" <div class=\"skrolovatkomale\">" ;
 require '../vypis_podmenu.php'; 
echo" </div>  <!-- skrolovatkomale  -->" ;
echo"
<br /><br />

  
</div>  <!-- ppodmenu  --> 
     
     </div>  <!-- pravy sloupec uzky  --> 
 
 <div id=\"levy-sloupec-siroky\"> 

  ";

  ?> 

  

 
