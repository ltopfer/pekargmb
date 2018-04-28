<?php
$kategorie='fotogalerie_nova';$kategorie_nazav='Fotogalerie';
$ppmenu=$_GET[ppmenu];
require '../hlavicka.php';
require '../menu.php';


     
 
 echo"

 <div id=\"pravy-sloupec-uzky\">
 <div class=\"podmenu\">
   <h2> $kategorie_nazav </h2>
   <svg id=\"podmenuButton\" width=\"40\" height=\"30\" xmlns=\"http://www.w3.org/2000/svg\">
                            <line id=\"l1-podmenu\" stroke-linecap=\"square\" stroke-linejoin=\"undefined\" y2=\"8\" x2=\"5\" y1=\"18\" x1=\"19\" stroke-width=\"4\" stroke=\"#333333\" fill=\"none\"/>
                            <line id=\"l2-podmenu\" stroke-linecap=\"square\" stroke-linejoin=\"undefined\" y2=\"8\" x2=\"35\" y1=\"18\" x1=\"21\" stroke-width=\"4\" stroke=\"#333333\" fill=\"none\"/>
                        </svg>  
     ";

/*
     echo"
          <a href=\"http://websidepbtridy.wz.cz/zakldfoto/mann2017cz/\" target=\"_blank\" class=\"tlacitkopodmenu\">Mannheim Exchange 2017</a>
     <a href=\"https://drive.google.com/file/d/0Bz6BOK42LGT0S3dDZUlWTXJZRkk/view?usp=sharing/\" target=\"_blank\" class=\"tlacitkopodmenu\">Humprecht 2017</a>
     <a href=\"https://youtu.be/XF6DUfQB4bU\" target=\"_blank\" class=\"tlacitkopodmenu\">Výbìrový zájezd 2017</a>
      <a href=\"http://websidepbtridy.wz.cz/zakldfoto/matac17/\" target=\"_blank\" class=\"tlacitkopodmenu\">Slavnostný vyøazení maturantù 2017 4.A 4.C</a>
     <a href=\"http://websidepbtridy.wz.cz/zakldfoto/matbo17/\" target=\"_blank\" class=\"tlacitkopodmenu\">Slavnostný vyøazení maturantù 2017 4.B 8.O</a>
      <a href=\"https://goo.gl/photos/dbWN2GMuHwj3hUE38\" target=\"_blank\" class=\"tlacitkopodmenu\">Jarní akademie 2017</a>
     <a href=\"http://websidepbtridy.wz.cz/zakldfoto/vaka2016/\" target=\"_blank\" class=\"tlacitkopodmenu\">Vánoèní akademie 2016</a>
      <a href=\"https://drive.google.com/file/d/0Bz6BOK42LGT0RzhWS0dxZTZTVE0/view?usp=sharing\" target=\"_blank\" class=\"tlacitkopodmenu\">Vánoèní akademie 2016 video</a>
     
      <a href=\"http://websidepbtridy.wz.cz/zakldfoto/veda16/\" target=\"_blank\" class=\"tlacitkopodmenu\">Vìda v ulicích</a>
     <a href=\"http://websidepbtridy.wz.cz/zakldfoto/mann2016cz/\" target=\"_blank\" class=\"tlacitkopodmenu\">Mannheim Exchange 2016</a>
<a href=\"http://websidepbtridy.wz.cz/zakldfoto/jaka2016/\" target=\"_blank\" class=\"tlacitkopodmenu\">Jarni akademie 2016</a>     
     <a href=\"http://websidepbtridy.wz.cz/zakldfoto/vaka2015/\" target=\"_blank\" class=\"tlacitkopodmenu\" >Vánoèní akademie 2015 </a> ";
echo"<a href=\"http://websidepbtridy.wz.cz/foto15/veda/\" target=\"_blank\" class=\"tlacitkopodmenu\" >Vìda v ulicích </a> ";     
echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/vyrazeni15_02/\" target=\"_blank\" class=\"tlacitkopodmenu\" >Slavnostní vyøazení maturantù 4.B a 8.O</a> ";
      echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/vyrazeni15_01/\" target=\"_blank\" class=\"tlacitkopodmenu\" >Slavnostní vyøazení maturantù 4.A a 4.C</a> ";     
 echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/mann15/mann2015de/\" target=\"_blank\" class=\"tlacitkopodmenu\" >Mannheim Exchange 2015</a> ";     
echo"<a href=\"https://drive.google.com/file/d/0Bz6BOK42LGT0dkZiUHZTMXViYWc/view?usp=sharing \" target=\"_blank\" class=\"tlacitkopodmenu\" >Koncert orchestru OLDA a pìveckého souboru LYRA (video)</a> ";     
echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/olda/ \" target=\"_blank\" class=\"tlacitkopodmenu\" >Koncert orchestru OLDA a pìveckého souboru LYRA (foto)</a> ";
echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/vaka2014/ \" target=\"_blank\" class=\"tlacitkopodmenu\" >Vánoèní akademie 2014 </a> ";       
 echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/mann14cz\" target=\"_blank\" class=\"tlacitkopodmenu\" >Mannheim Exchange 2014</a> ";     
 echo"<a href=\"$adresawebu"."fotogalerie_nova/zdroje/vyberovy_zajezd/vyberopvy_zajezd_2014.pdf\" target=\"_blank\" class=\"tlacitkopodmenu\" >Výbìrový zájezd  2014 (*.pdf)</a> ";     
 echo"<a href=\"http://websidepbtridy.wz.cz/foto/galer/\" target=\"_blank\" class=\"tlacitkopodmenu\" >Jarní akademie 2014 </a> ";     
   echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/sportovni_ak_2013 \" target=\"_blank\" class=\"tlacitkopodmenu\" >Sportovní akademie 2013 </a> ";     
   echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/vanocni_ak_2013 \" target=\"_blank\" class=\"tlacitkopodmenu\" >Vánoèní akademie 2013 </a> ";     
     
     echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/mannheimDE/index.htm \" target=\"_blank\" class=\"tlacitkopodmenu\" >Mannheim 2013 - druhá èást výmìnného zájezdu</a> ";
      echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/vyrazenimat2/index.htm \" target=\"_blank\" class=\"tlacitkopodmenu\" >Slavnostní vyøazení maturantù 4.B a 8.O</a> ";
      echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/vyrazenimat1/index.htm\" target=\"_blank\" class=\"tlacitkopodmenu\" >Slavnostní vyøazení maturantù 4.A a 4.C</a> ";
      echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/mannheim2013/index.htm\" target=\"_blank\" class=\"tlacitkopodmenu\" >Mannheim Exchange 2013</a> ";
     echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/jakademie2013/index.htm\" target=\"_blank\" class=\"tlacitkopodmenu\" >Jarní akademie 19. 3. 2013 </a> ";
       echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/akademie12/index.htm\" target=\"_blank\" class=\"tlacitkopodmenu\" >Vánoèní akademie</a> "; 
      echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/armada/index.htm\" target=\"_blank\" class=\"tlacitkopodmenu\" >Den s armádou</a> "; 
 echo"<a href=\"http://websidepbtridy.wz.cz/zakldfoto/mannheimCZ/index.htm\" target=\"_blank\" class=\"tlacitkopodmenu\" >Mannheim 2012 – èást MB</a> ";     
 echo"<a href=\"$adresawebu"."fotogalerie_nova/zdroje/vyberovy_zajezd/polsko.ppsx\" target=\"_blank\" class=\"tlacitkopodmenu\" >Výbìrový zájezd Polsko 2012 (*.ppsx) </a> ";     
 echo"<a href=\"$adresawebu"."fotogalerie_nova/zdroje/24_1_2011/index.htm\" target=\"_blank\" class=\"tlacitkopodmenu\" >Lyžaøský kurz Rakousko 7. - 13. 3. 2010 </a> ";
 echo"<a href=\"$adresawebu"."fotogalerie_nova/zdroje/pezinok/index.htm\" target=\"_blank\" class=\"tlacitkopodmenu\" >Pezinok </a> ";
  echo"<a href=\"$adresawebu"."fotogalerie_nova/zdroje/mannheim_16-22_ 5_ 2010/index.htm\" target=\"_blank\" class=\"tlacitkopodmenu\" >Mannheim MB 16. - 22. 5. 2010</a> ";
  echo"<a href=\"$adresawebu"."fotogalerie_nova/zdroje/jarni_akademie_31_3_2011/index.htm\" target=\"_blank\" class=\"tlacitkopodmenu\" >Jarní akademie 31.3.2011</a> ";      
//require '../vypis_podmenu.php'; 
*/


echo 
   "<a href=\"#17\" class=\"tlacitkopodmenu\">2017/2018</a>
    <a href=\"#16\" class=\"tlacitkopodmenu\">2016/2017</a>
    <a href=\"#15\" class=\"tlacitkopodmenu\">2015/2016</a>
    <a href=\"#14\" class=\"tlacitkopodmenu\">2014/2015</a>
    <a href=\"#13\" class=\"tlacitkopodmenu\">2013/2014</a>
    <a href=\"#12\" class=\"tlacitkopodmenu\">2012/2013</a>
    <a href=\"#11\" class=\"tlacitkopodmenu\">2011/2012</a>
    <a href=\"#10\" class=\"tlacitkopodmenu\">2010/2011</a>
";

echo" </div>  <!-- ppodmenu  --> 

     </div>  <!-- pravy sloupec uzky  --> 
 
 <div id=\"levy-sloupec-siroky\"> 
  ";

  ?> 

  

 
