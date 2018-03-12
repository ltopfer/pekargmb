<?php
$cislosrovnitkem='='.$vyber;
$cislosrovnitkemppmenu='='.$ppmenu.'#'.$ppmenu;//tadz to dod2lat
$cislosrovnitkemppmenubezcile='='.$ppmenu;//tadz to dod2lat
$cislosrovnitkemvnovinkach='='.$vyber.'&amp;co='.$co;//tadz to dod2lat   
for ($i=0;$i<count($polozka) ;$i++ ) {
$aname='';

if (( substr($polozka[$i],-4,4)=='.pdf' )||( substr($polozka[$i],-5,5)=='.aspx' )||( substr($polozka[$i],-3,3)=='.cz' )|| ( substr($polozka[$i],-4,4)=='.cz/' )||($kategorie=='elearning')||( substr($polozka[$i],-4,4)=='.doc' ))  $cil='onclick="trackOutboundLink(this); return false;"'; else $cil='';

if ($ppmenu!='') {
if (strstr($polozka[$i],'.pdf') ) $cil='onclick="trackOutboundLink(this); return false;"'; else $cil='';
  if ((strstr($polozka[$i],'=')==$cislosrovnitkemppmenu) || (strstr($polozka[$i],'=')==$cislosrovnitkemppmenubezcile) ) {
  $tridapolozkyppmenu='tridappmenuakt'; 
$aname="<a name=\"$ppmenu\"></a>";
{
  if ($ppkat[$i]==$ppmenu) {
    $tridapolozkyppmenu='tridapppmenu';
    $souborsparam=$soubor.'?ppmenu='.$ppmenu;
$aname='';
//echo  $souborsparam;
    if (strstr($souborsparam,$polozka[$i])) $tridapolozkyppmenu='tlacitkopodmenuakt' ; 
   }
   
   }
  }
  
  else {
  	$tridapolozkyppmenu='tlacitkopodmenu';
  }

echo"$aname<a href=\"$polozka[$i]\" class=\"$tridapolozkyppmenu\"  $cil > $nazev[$i] </a>";
	
}
else{
$podminka= $vyber!='' ? !strstr($soubor,$polozka[$i])&& !((strstr($polozka[$i],'=')==$cislosrovnitkem)||(strstr($polozka[$i],'=')==$cislosrovnitkemvnovinkach) ): !strstr($soubor,$polozka[$i]);
if ($podminka) $tridapolozky='tlacitkopodmenu' ; else $tridapolozky='tlacitkopodmenuakt';


echo"<a href=\"$polozka[$i]\" class=\"$tridapolozky\"  $cil > $nazev[$i] </a> ";
}
}

?>
