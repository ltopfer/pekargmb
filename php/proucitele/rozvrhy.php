<?php
$soubor=__FILE__;
$zobr=$_GET["zobr"];

require "hlavicka.php";
?>

<h4>Rozvrhy</h4>

<iframe src="<?php
             switch ($zobr) {
                 case "tridy":
                     echo "../rozvrh/rozvrhtr.htm";
                     break;
                 case "ucitele":
                     echo "../rozvrh/rozvrhuc.htm";
                     break;
                 case "supl":
                     echo "http://supl.esy.es/supl/suplovtr.htm";
                     break;
             }
?>"></iframe>

<?php
require "paticka.php";
?>