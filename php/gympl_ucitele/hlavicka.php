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
 	echo"<a href=\"telefon.php?prohlizeno=telefon \" class=\"tlacitkopodmenuakt\">Telefonn� linky</a>";
 }
else {
	echo"<a href=\"telefon.php?prohlizeno=telefon \" class=\"tlacitkopodmenu\">Telefonn� linky</a>";	
}
 if ($prohlizeno=='mapa') {
 	echo"<a href=\"mapa.php?prohlizeno=mapa \" class=\"tlacitkopodmenuakt\">Poloha �koly na map�</a>";
 }
else {
	echo"<a href=\"mapa.php?prohlizeno=mapa \" class=\"tlacitkopodmenu\">Poloha �koly na map�</a>";	
}

echo"
 <br />
<a href=\"../gympl_psycholog/gympl_psycholog.php \" class=\"tlacitkopodmenu\">�koln� psycholog</a>
<a href=\"../gympl_poradce/gympl_poradce.php \" class=\"tlacitkopodmenu\">V�chovn� poradce</a>  
  ";
     
  
  echo"
  <h5> Kategorie zam�stnanc� </h5>
  ";
if ($hodnotasloupce=='u�itel�') {
echo"
  <a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=u�itel�  \" class=\"tlacitkopodmenuakt\"> U�itel�</a>";	
} 
else {
echo"
  <a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=u�itel�  \" class=\"tlacitkopodmenu\"> U�itel�</a>";	
} 
if ($hodnotasloupce=='thp pracovn�ci') {
 echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=thp pracovn�ci \" class=\"tlacitkopodmenuakt\"> THP pracovn�ci</a>";
  }
else {
 echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=thp pracovn�ci \" class=\"tlacitkopodmenu\"> THP pracovn�ci</a>";	
} 

if ($hodnotasloupce=='spr�vn� zam�stnanci') {
echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=spr�vn� zam�stnanci \" class=\"tlacitkopodmenuakt\"> Spr�vn� zam�stnaneci</a>";	
}
else {
echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=spr�vn� zam�stnanci \" class=\"tlacitkopodmenu\"> Spr�vn� zam�stnaneci</a>";	
}
if ($hodnotasloupce=='hala') {
echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=hala \" class=\"tlacitkopodmenuakt\"> Hala</a>";	
}
else {
	echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=hala \" class=\"tlacitkopodmenu\"> Hala</a>";
}
if ($hodnotasloupce=='j�delna') {
echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=j�delna \" class=\"tlacitkopodmenuakt\"> J�delna</a>";	
}
else {
echo"
<a href=\"gympl_ucitele.php?sloupec=kategorie&amp;hodnotasloupce=j�delna \" class=\"tlacitkopodmenu\"> J�delna</a>";	
}
if ($prohlizeno=='celyseznam') {
echo"
   <a href=\"gympl_ucitele.php?prohlizeno=celyseznam&amp;zobr= \" class=\"tlacitkopodmenuakt\">Seznam v�ech zam�stnanc� </a> 
  
  ";	
}
else {
echo"
   <a href=\"gympl_ucitele.php?prohlizeno=celyseznam&amp;zobr= \" class=\"tlacitkopodmenu\">Seznam v�ech zam�stnanc� </a> 
  
  ";	
}

  
  echo"
   <br />
   <h5> Zam�stnanci �koly </h5>  
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

  

 
