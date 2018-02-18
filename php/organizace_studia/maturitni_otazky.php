<?php
$soubor=__FILE__;
require "hlavicka.php";

?>  
 <h4> Maturitní otázky 2017/2018 –&nbsp;profilová èást</h4>
 <div class="obrvlevo">
   

<?php

$mo=obsah_adresare(maturitni_otazky);
echo"<ul>";
for ($i=0;$i<count($mo) ;$i++ ) {
$cil='maturitni_otazky/'.$mo[$i];
echo" <li><a href=\"$cil\" target=\"_blank\">$mo[$i]</a></li>  \n";
                                } 
echo"</ul>"; 
                               
?> 
 </div> 
 <div class="obrvpravo">
   

<?php
$cislofotky=rand(1, 9);
$adresafotky='../budova_bbb/'.$cislofotky.'.jpg';
echo"
<img src=\"$adresafotky\" width=\"400\" class=\"obrvpravo\" />
";
?>
 </div>
<?php
require "paticka.php";
?>
