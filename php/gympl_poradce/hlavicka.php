<?php
$zobr=$_GET[zobr];$vyber=$zobr;
$kategorie='gympl_poradce';$kategorie_nazav='Výchovný poradce';
require '../hlavicka.php';
require '../menu.php';
 require("cporadce.php");
$pro_seznam_novinek=new CRubrika_Foto('gympl_poradce');
 $seznam_novinek= $pro_seznam_novinek->VyberSeznamNovinek();
// echo"po4et";echo count($seznam_novinek[id]);
for ($i=0;$i<count($seznam_novinek[id]) ;$i++ ) { 
$polozka[$i]='gympl_poradce.php?zobr='.$seznam_novinek[id][$i]; 
$nazev[$i]=$seznam_novinek[nadpis][$i];
                                     }
 


$stylprehleduzprav=($zobr=='')?'tlacitkopodmenuakt' :'tlacitkopodmenu';     
 
 echo"

 <div id=\"pravy-sloupec-uzky\">
 <div class=\"podmenu\">
  <h2> $kategorie_nazav </h2>
   <svg id=\"podmenuButton\" width=\"40\" height=\"30\" xmlns=\"http://www.w3.org/2000/svg\">
                            <line id=\"l1-podmenu\" stroke-linecap=\"square\" stroke-linejoin=\"undefined\" y2=\"8\" x2=\"5\" y1=\"18\" x1=\"19\" stroke-width=\"4\" stroke=\"#333333\" fill=\"none\"/>
                            <line id=\"l2-podmenu\" stroke-linecap=\"square\" stroke-linejoin=\"undefined\" y2=\"8\" x2=\"35\" y1=\"18\" x1=\"21\" stroke-width=\"4\" stroke=\"#333333\" fill=\"none\"/>
                        </svg>
  <a href=\"gympl_poradce.php?zobr= \" class=\"$stylprehleduzprav\">Pøehled zpráv</a>
     ";
require '../vypis_podmenu.php';

                                          
echo" 

<hr />
 <a href=\"administrace.php \" class=\"tlacitkopodmenu\"> Editace rubriky <br /> ( pro zamìstnance ) </a>
</div>  <!-- ppodmenu  --> 
   <!--<div class=\"centrovano\">
<br />
  <img src=\"../foto_skola/gymp.jpg\" alt=\"foto\" />
  <br />
</div>  -->
     </div>  <!-- pravy sloupec uzky  --> 
 
 <div id=\"levy-sloupec-siroky\"> 

  ";

  ?> 

  

 
