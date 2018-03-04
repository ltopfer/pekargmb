<?php
$soubor=__FILE__;
require "hlavicka.php";
?>  
     <h4>
 Nabízené studijní
      bloky od 3. roèníku</h4>
      (realizovány formou
      volitelných pøedmìtù)
    </p>
    <ul>
      <li>
      pøírodovìdný -
      vhodný pro zájemce o studium na VOŠ (vyšší
      odborná škola) a na VŠ pøírodovìdných,
      lékaøských, tìlovýchovných a pedagogických
      </li>

      <li>
      matematika
      a výpoèetní technika - vhodný
      pro zájemce o studium na VOŠ a na VŠ technických,
      pøírodovìdných, ekonomických a pedagogických
      </li>
      <li>
      humanitní
      - vhodný pro zájemce o studium
      na VOŠ a na filozofických, právnických, umìleckých
      a pedagogických fakultách
      </li>
    </ul>
   <center>
   <?php
$cislofotky=rand(1, 9);
$adresafotky='../budova_bbb/'.$cislofotky.'.jpg';
echo"
<img src=\"$adresafotky\" width=\"400\"  />
";
?> 
   
   </center>

  <?php
require "paticka.php";
?>
