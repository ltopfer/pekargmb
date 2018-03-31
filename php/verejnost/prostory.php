<?php
$soubor=__FILE__;


$zobr=$_GET["zobr"];

$cesta = realpath("prostory/".$zobr);
$foto = "";
if($cesta != false && strstr($cesta, "prostory") != false)
{
    $foto = "prostory/".$zobr;
}

require "hlavicka.php";

?> 
<h4>Naše prostory</h4>

<?php

if($zobr=="" && $foto != "") // seznam prostoru
{
    echo "<p>Naše prostory...</p>
        <a href=\"prostory.php?ppmenu=prost&zobr=knihovna\">Knihovna</a><br>
        <a href=\"prostory.php?ppmenu=prost&zobr=sport\">Sportovište</a><br>
        <a href=\"prostory.php?ppmenu=prost&zobr=ucebny\">Ucebny</a><br>
    ";
        
}
else
{
    @include "$foto/text.php";
    
    echo "
    <div class=\"prostory\">
        <script>
            $(document).ready(function() {
                $(\".obrazekProstory\").click(function() {
                    $(this).toggleClass(\"velkyProstory\");
                });
            });
        </script>
        ";
    //var_dump($foto);

    $files = glob("$foto/*.{jpg,png,gif}", GLOB_BRACE);
    $popisky = file("$foto/popisky.txt");
    //var_dump($popisky);
    //$len = strlen($foto) + 1;
    $i=0;
    
    if($files)    
        foreach($files as $file) {
            //var_dump($file);
            echo "<div class=obrazekProstory>
                    <div class=\"overlay\"></div>
                    <img src=\"$file\">
                    <span class=popisek>". $popisky[$i] ."</span>
                </div>"; //substr($file, $len, strlen($file) - $len - 4)
            $i++;
        }

    echo "
    </div>";
}
?>


<?php
require "paticka.php";
?>
