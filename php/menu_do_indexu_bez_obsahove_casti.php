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

echo"<div id=\"odkazy\"><a href=\"ang_gympl/index.php\"><img  id=\"gb\" src=\"{$adresawebu}obr/gb.png\"></a><a href=\"https://www.facebook.com/pekargmb\"><img class=\"odkaz\" src=\"{$adresawebu}obr/fb-art.png\"></a><a href=\"{$adresawebu}rss/rss_nanoivinky.php\"><img class=\"odkaz\" src=\"{$adresawebu}obr/Feed-icon.svg\"></a><a href=\"{$adresawebu}pro_vyhledavani/pro_vyhledavani.php\"><img class=\"odkaz\" src=\"{$adresawebu}obr/50744-200.png\"></a>
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

  

 
