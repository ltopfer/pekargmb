<?php 
$soubor=__FILE__;
require "hlavicka.php";

  ?> 

<?php
$zobr=$_GET[zobr];

if(empty($zobr))
    echo "<h4>Adresa školy</h4>
<div class=adresa>
    <div>
Palackého 211 <br>
29380 Mladá Boleslav <br>
tel: 326375951 <br>
IÈO: 48683868 <br>
<a href=mailto:pekargmb@pekargmb.cz class=\"email\">pekargmb@pekargmb.cz </a> <br>
(<a href=mailto:GJPMB@kr-s.cz class=\"email\">GJPMB@kr-s.cz</a>) <br>
datová schránka: arsjhws <br>
è. úètu školy pro platby: <br> 
19-5779840267/0100 </div>
    <div>
     Øeditel školy: <br>
     <b>Vlastimil Volf</b> <a href=\"mailto:volf@pekargmb.cz\" class=\"email\">volf@pekargmb.cz</a> <br>
<br>
Zástupci øeditele: <br> 
<b>Mgr. Petr Bárta</b> <a href=\"mailto:barta@pekargmb.cz\" class=\"email\">barta@pekargmb.cz</a><br>
<b>PaedDr. Alena Budínová</b> <a href=\"mailto:budinova@pekargmb.cz\" class=\"email\">budinova@pekargmb.cz</a><br> 
<b>Mgr. Petr Dostál</b> <a href=\"mailto:dostal.petr@pekargmb.cz\" class=\"email\">dostal.petr@pekargmb.cz</a> <br> 
    </div>
</div>
";


echo"<h4> Seznam zamìstnancù  ".$hodnotasloupce." </h4>";


 
 $pro_vypis=new CRubrika_Foto('gympl_ucitele');
 $pro_vypis->NastavAdresarFotek('foto/');                                   
$pro_vypis->FormatujObashRubriky($zobr,$sloupec,$hodnotasloupce); 




require "paticka.php";
?>

    
