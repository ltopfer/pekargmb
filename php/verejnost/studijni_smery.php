<?php
$soubor=__FILE__;
require "hlavicka.php";
?>  
     <h4>
 Nab�zen� studijn�
      bloky od 3. ro�n�ku</h4>
      (realizov�ny formou
      voliteln�ch p�edm�t�)
    </p>
    <ul>
      <li>
      p��rodov�dn� -
      vhodn� pro z�jemce o studium na VO� (vy���
      odborn� �kola) a na V� p��rodov�dn�ch,
      l�ka�sk�ch, t�lov�chovn�ch a pedagogick�ch
      </li>

      <li>
      matematika
      a v�po�etn� technika - vhodn�
      pro z�jemce o studium na VO� a na V� technick�ch,
      p��rodov�dn�ch, ekonomick�ch a pedagogick�ch
      </li>
      <li>
      humanitn�
      - vhodn� pro z�jemce o studium
      na VO� a na filozofick�ch, pr�vnick�ch, um�leck�ch
      a pedagogick�ch fakult�ch
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
