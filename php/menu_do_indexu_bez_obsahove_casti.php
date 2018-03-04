<?php
//$polozkahl[]=$adresawebu.'index.php';$nazevhl[]='Domù';$titl[]='Domù';
$polozkahl[]=$adresawebu.'proucitele/plan_akci.php#a';$nazevhl[]='Pro&nbsp;uèitele';$titl[]='Pro uèitele';
$polozkahl[]=$adresawebu.'verejnost/prijimacky.php#a';$nazevhl[]='Pro&nbsp;veøejnost';$titl[]='Pro veøejnost, rodièe a uchazeèe o studium';
$polozkahl[]=$adresawebu.'organizace_studia/skolni_rad.php#a';$nazevhl[]='Pro&nbsp;studenty';$titl[]='Pro studenty';

$polozkahl[]=$adresawebu.'gympl_novinky/gympl_novinky.php';$nazevhl[]='Novinky';$titl[]='Novinky';
$polozkahl[]=$adresawebu.'gympl_ucitele/gympl_ucitele.php';$nazevhl[]='Kontakty';$titl[]='Kontakty';
$polozkahl[]=$adresawebu.'dokumentace/skolni_rad.php';$nazevhl[]='Dokumenty';$titl[]='Dokumenty, plány, školní øád a žádosti';
$polozkahl[]=$adresawebu.'projekty/podpora.php';$nazevhl[]='Projekty';$titl[]='Projekty';
$polozkahl[]=$adresawebu.'fotogalerie_nova/fotogalerie_nova.php';$nazevhl[]='Fotogalerie';$titl[]='Fotogalerie';

echo"<div id=\"menu\">";
echo"<ul id=\"textmenul\">";

for ($i=0;$i<3 ;$i++)
{
    if (strpos($polozkahl[$i], $kategorie) !== false)
        echo "<li class=\"textmenul_akt\">";
    else
        echo "<li>";
    echo "<a href=\"$polozkahl[$i]\" class=\"$tridapolozky\" title=\"$titl[$i]\">$nazevhl[$i]</a></li>";
} 

echo "</ul>";       
echo"  <ul id=\"textmenup\"> ";

for ($i=3;$i<count($polozkahl) ;$i++)
{
    if (strpos($polozkahl[$i], $kategorie) !== false)
        echo "<li class=\"textmenup_akt\">";
    else
        echo "<li>";
    echo "<a href=\"$polozkahl[$i]\" class=\"$tridapolozky\" title=\"$titl[$i]\">$nazevhl[$i]</a></li> ";
}

echo" </ul>";

echo"<div id=\"odkazy\"><a href=\"/ang_gympl/index.php\"><img  id=\"gb\" src=\"{$adresawebu}obr/gb.png\"></a><a href=\"https://www.facebook.com/pekargmb\"><img class=\"odkaz\" src=\"{$adresawebu}obr/fb-art.png\"></a><a href=\"{$adresawebu}rss/rss_nanoivinky.php\"><img class=\"odkaz\" src=\"{$adresawebu}obr/Feed-icon.svg\"></a><a href=\"{$adresawebu}pro_vyhledavani/pro_vyhledavani.php\">
    <svg class=\"odkaz\" id=\"vyhledavani\" version=\"1.0\" xmlns=\"http://www.w3.org/2000/svg\"
width=\"200.000000pt\" height=\"200pt\" viewBox=\"0 0 200.000000 200.000000\"
    preserveAspectRatio=\"xMidYMid meet\">
    <g transform=\"translate(0.000000,200.000000) scale(0.100000,-0.100000)\"
    fill=\"#000000\" stroke=\"none\">
    <path d=\"M634 1931 c-207 -33 -380 -161 -469 -345 -51 -107 -65 -167 -65 -280
0 -172 61 -319 184 -442 134 -133 284 -191 475 -181 122 6 196 28 293 87 l63
39 50 -49 49 -49 -22 -24 -21 -23 257 -256 c141 -141 267 -261 279 -267 12 -6
42 -11 67 -11 39 0 52 6 84 34 35 33 37 38 37 95 l0 61 -267 267 -267 267 -24
-22 -23 -22 -48 49 -47 48 40 64 c64 103 94 205 94 324 1 122 -13 185 -65 294
-56 119 -161 223 -279 279 -46 22 -104 44 -129 50 -66 16 -187 22 -246 13z
m182 -142 c266 -49 451 -324 390 -583 -54 -229 -248 -386 -475 -386 -143 0
-263 52 -359 155 -92 98 -132 198 -132 331 0 103 26 191 81 273 52 78 107 125
195 167 106 52 188 64 300 43z\"/>
    <path d=\"M588 1718 c-56 -15 -46 -28 21 -28 122 0 257 -65 357 -171 90 -97
132 -190 143 -324 l7 -80 17 54 c70 223 -65 480 -287 546 -56 17 -200 18 -258
3z\"/>
    </g>
    </svg></a>
    </div>"; 
echo" <svg id=\"menuButton\" width=\"40\" height=\"40\" xmlns=\"http://www.w3.org/2000/svg\">
                    <line id=\"l1\" stroke-linecap=\"square\" stroke-linejoin=\"undefined\" y2=\"10\" x2=\"35\" y1=\"10\" x1=\"10\" stroke-width=\"4\" stroke=\"#000\" fill=\"none\"/>
                    <line id=\"l2\" stroke-linecap=\"square\" stroke-linejoin=\"undefined\" y2=\"20\" x2=\"35\" y1=\"20\" x1=\"10\" stroke-width=\"4\" stroke=\"#000\" fill=\"none\"/>
                    <line id=\"l3\" stroke-linecap=\"square\" stroke-linejoin=\"undefined\" y2=\"30\" x2=\"35\" y1=\"30\" x1=\"10\" stroke-width=\"4\"stroke=\"#000\" fill=\"none\"/>
                </svg> ";           
echo"</div >  <!-- k menu -->";      
       
echo" </div><!--div id=header  -->  ";// ukonèení divu k  div id="header" je v hlavièce           
//echo"  soubor:$soubor";


  



  ?> 

  

 
